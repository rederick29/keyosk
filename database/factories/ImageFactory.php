<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product_id = fake()->randomElement(DB::table('products')->pluck('id'));
        $location = fake()->imageUrl(word: DB::table('products')->where('id', $product_id)->value('name'));

        return [
            'product_id' => $product_id,
            'location' => $location,
        ];
    }

    public function forProduct(Product $product): Factory|ImageFactory
    {
        return $this->state(function (array $attributes) use ($product)
        {
            return [
                'product_id' => $product->id,
                'location' => fake()->imageUrl(word: $product->name),
            ];
        });
    }
}
