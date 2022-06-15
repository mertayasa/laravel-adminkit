<?php

namespace Tests\Feature;

use App\DataTables\ProductCategoryDataTable;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ProductCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        // Run all the setUp() code defined in parent (TestCase) class
        parent::setUp();

        // Create admin account and login (actingAs)
        $this->actingAs($this->createAdmin());        
    }

    public function test_category_screen_can_be_rendered()
    {
        // Visit the profile page
        $response = $this->get(route('product-category.index'));
        $response->assertStatus(200);
    }

    public function test_datatable_data()
    {
        ProductCategory::factory()->count(10)->create();
        $datatable = (new ProductCategoryDataTable())->ajax()->getData(true);

        $product_categories = ProductCategory::all();

        $this->assertEquals($product_categories->count(), count($datatable['data']));
    }

    public function test_create_category_screen_can_be_rendered()
    {
        $response = $this->get(route('product-category.create'));
        $response->assertStatus(200);
    }

    public function test_failed_to_store_category()
    {
        $response = $this->post(route('product-category.store'), [
            'name' => '',
            'image' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
        $response->assertSessionHasErrors('image');
    }

    public function test_success_to_store_category()
    {
        $response = $this->post(route('product-category.store'), [
            'name' => 'New Category',
            'image' => UploadedFile::fake()->image('image.jpg'),
        ]);

        $product_category = ProductCategory::latest()->first();

        $response->assertRedirect(route('product-category.index'));
        $response->assertSessionHas('success'); // Assert that session has success message
        $response->assertSessionHasNoErrors(); // Assert that session has no error message
        $this->assertTrue(File::exists(public_path($product_category->image)));
        $this->assertEquals('New Category', $product_category->name);

        // Delete image after test
        $this->deleteFile($product_category->image);
    }

    public function test_404_edit()
    {
        $response = $this->get(route('product-category.edit', 'wrong-slug'));

        $response->assertStatus(404);
    }

    public function test_edit_product_category_screen_can_be_rendered()
    {
        ProductCategory::factory()->count(10)->create();
        $response = $this->get(route('product-category.edit', ProductCategory::first()));
        $response->assertStatus(200);
    }


    public function test_failed_update_category()
    {
        $product_category = ProductCategory::factory()->create();

        $response = $this->patch(route('product-category.update', $product_category), [
            'name' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
    }

    public function test_404_update()
    {
        $response = $this->patch(route('product-category.update', 'wrong-slug'), []);

        $response->assertStatus(404);
    }

    public function test_success_to_update_category()
    {
        $product_category = ProductCategory::factory()->create();

        $response = $this->patch(route('product-category.update', $product_category), [
            'name' => 'Updated Category',
            'image' => UploadedFile::fake()->image('image.jpg'),
        ]);

        $product_category = ProductCategory::latest()->first();

        $response->assertRedirect(route('product-category.index'));
        $response->assertSessionHas('success'); // Assert that session has success message
        $response->assertSessionHasNoErrors(); // Assert that session has no error message
        $this->assertTrue(File::exists(public_path($product_category->image)));
        $this->assertEquals('Updated Category', $product_category->name);

        // Delete image after test
        $this->deleteFile($product_category->image);
    }

    public function test_404_destroy()
    {
        $response = $this->delete(route('product-category.destroy', 'wrong-slug'));

        $response->assertStatus(404);
    }

    public function test_success_destroy()
    {
        $product_category = ProductCategory::factory()->create();
        $response = $this->delete(route('product-category.destroy', $product_category));

        $response->assertStatus(200);
        $response->assertJson([
            'message' => trans('flash.success.delete')
        ]);

        $product_category_count = ProductCategory::count();
        $this->assertEquals(0, $product_category_count);
    }

}
