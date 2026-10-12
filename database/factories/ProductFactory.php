<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => fake()->words(3, true),
            'sku' => fake()->unique()->bothify('SKU-####-????'),
            'description' => fake()->sentence(),
            'stock' => fake()->numberBetween(0, 200),
            'price' => fake()->randomFloat(2, 1000, 5000000),
            'minimum_stock' => fake()->numberBetween(1, 20),
        ];
    }
}
