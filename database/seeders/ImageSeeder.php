<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        $products->each(function ($product) {
            // Get the highest current priority or start at -1
            $existingPriority = $product->images()->max('priority') ?? -1;

            // Generate a random number of images for the product and assign them a priority
            $imageCount = random_int(1, 5);
            for ($i = 1; $i <= $imageCount; $i++) {
                Image::factory()->forProduct($product)->create([
                    'priority' => ++$existingPriority,
                ]);
            }
        });
    }
}
