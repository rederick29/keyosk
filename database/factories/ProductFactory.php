<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'short_description' => fake()->sentence(),
            'description' => fake()->realText(255),
            'stock' => fake()->randomNumber(2),
            'price' => fake()->randomFloat(2, 5, 100),
        ];
    }
}
