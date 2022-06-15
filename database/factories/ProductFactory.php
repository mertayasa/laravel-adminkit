<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'image' => '/default/product.png',
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 0, 100),
            'discount_price' => $this->faker->randomFloat(2, 0, 100),
            'quantity' => $this->faker->numberBetween(0, 100),
            'category_id' => ProductCategory::inRandomOrder()->first()->id,
        ];
    }
}
