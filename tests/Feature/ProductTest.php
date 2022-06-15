<?php

namespace Tests\Feature;

use App\DataTables\ProductCategoryDataTable;
use App\DataTables\ProductDataTable;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Faker\Factory as Faker;


class ProductTest extends TestCase
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
        $response = $this->get(route('product.index'));
        $response->assertStatus(200);
    }

    public function test_datatable_data()
    {
        ProductCategory::factory()->count(10)->create();
        Product::factory()->count(10)->create();
        $datatable = (new ProductDataTable())->ajax()->getData(true);

        $product_categories = Product::all();

        $this->assertEquals($product_categories->count(), count($datatable['data']));
    }

    public function test_create_category_screen_can_be_rendered()
    {
        ProductCategory::factory()->count(10)->create();
        $response = $this->get(route('product.create'));
        $response->assertStatus(200);
    }

    public function test_failed_to_store_product()
    {
        $response = $this->post(route('product.store'), [
            'name' => '',
            'description' => '',
            'price' => '',
            'discount_price' => 0,
            'quantity' => '',
            'category_id' => '',
            'image' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
        $response->assertSessionHasErrors('description');
        $response->assertSessionHasErrors('price');
        $response->assertSessionHasErrors('discount_price');
        $response->assertSessionHasErrors('quantity');
        $response->assertSessionHasErrors('category_id');
        $response->assertSessionHasErrors('image');
    }

    public function test_success_to_store_category()
    {
        ProductCategory::factory()->create();
        $faker = Faker::create();

        $data = [
            'name' => $faker->word(),
            'description' => $faker->realTextBetween($minNbChars = 50, $maxNbChars = 150, $indexSize = 2),
            'price' => rand(10000, 100000),
            'discount_price' => rand(1, 10),
            'quantity' => rand(1, 10),
            'category_id' => ProductCategory::first()->id,
            'image' => UploadedFile::fake()->image('image.jpg'),
        ];

        $response = $this->post(route('product.store'), $data);

        $product = Product::latest()->first();

        $response->assertRedirect(route('product.index'));
        $response->assertSessionHas('success'); // Assert that session has success message
        $response->assertSessionHasNoErrors(); // Assert that session has no error message
        $this->assertTrue(File::exists(public_path($product->image)));
        $this->assertEquals($data['name'], $product->name);
        $this->assertEquals($data['description'], $product->description);
        $this->assertEquals($data['price'], $product->price);
        $this->assertEquals($data['discount_price'], $product->discount_price);
        $this->assertEquals($data['quantity'], $product->quantity);
        $this->assertEquals($data['category_id'], $product->category_id);

        // Delete image after test
        $this->deleteFile($product->image);
    }

    public function test_404_edit()
    {
        $response = $this->get(route('product.edit', 'wrong-slug'));

        $response->assertStatus(404);
    }

    public function test_edit_product_screen_can_be_rendered()
    {
        ProductCategory::factory()->count(10)->create();
        Product::factory()->create();
        $response = $this->get(route('product.edit', Product::first()));
        $response->assertStatus(200);
    }

    public function test_failed_update_category()
    {
        ProductCategory::factory()->count(10)->create();
        $product = Product::factory()->create();

        $response = $this->patch(route('product.update', $product), [
            'name' => '',
            'description' => '',
            'price' => '',
            'discount_price' => 0,
            'quantity' => '',
            'category_id' => '',
            'image' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
        $response->assertSessionHasErrors('description');
        $response->assertSessionHasErrors('price');
        $response->assertSessionHasErrors('discount_price');
        $response->assertSessionHasErrors('quantity');
        $response->assertSessionHasErrors('category_id');
    }

    public function test_404_update()
    {
        $response = $this->patch(route('product.update', 'wrong-slug'), []);

        $response->assertStatus(404);
    }

    public function test_success_to_update_category()
    {
        ProductCategory::factory()->create();
        $product = Product::factory()->create();

        $data = [
            'name' => 'Updated Category',
            'description' => 'Updated Description',
            'price' => rand(10000, 100000),
            'discount_price' => rand(1, 10),
            'quantity' => rand(1, 10),
            'category_id' => ProductCategory::first()->id,
            'image' => UploadedFile::fake()->image('image.jpg'),
        ];

        $response = $this->patch(route('product.update', $product), $data);

        $product = Product::latest()->first();

        $response->assertRedirect(route('product.index'));
        $response->assertSessionHas('success'); // Assert that session has success message
        $response->assertSessionHasNoErrors(); // Assert that session has no error message
        $this->assertTrue(File::exists(public_path($product->image)));
        $this->assertEquals($data['name'], $product->name);
        $this->assertEquals($data['description'], $product->description);
        $this->assertEquals($data['price'], $product->price);
        $this->assertEquals($data['discount_price'], $product->discount_price);
        $this->assertEquals($data['quantity'], $product->quantity);
        $this->assertEquals($data['category_id'], $product->category_id);

        // Delete image after test
        $this->deleteFile($product->image);
    }

    public function test_404_destroy()
    {
        $response = $this->delete(route('product.destroy', 'wrong-slug'));

        $response->assertStatus(404);
    }

    public function test_success_destroy()
    {
        ProductCategory::factory()->create();
        $product = Product::factory()->create();
        $response = $this->delete(route('product.destroy', $product));

        $response->assertStatus(200);
        $response->assertJson([
            'message' => trans('flash.success.delete')
        ]);

        $product_count = Product::count();
        $this->assertEquals(0, $product_count);
    }

}
