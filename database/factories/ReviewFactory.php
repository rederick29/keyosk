<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rating' => fake()->randomFloat(1,0,5),
            'subject' => fake()->realText(100),
            'comment' => fake()->realText(1000),
            'user_id' => fake()->randomElement(DB::table('users')->pluck('id')),
            'product_id' => fake()->randomElement(DB::table('products')->pluck('id')),
        ];
    }
}
