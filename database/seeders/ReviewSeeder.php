<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            $user = User::all()->random();
            $product = Product::all()->random();
            // ensure [user_id, product_id] is unique
            if (Review::findReview($product->id, $user->id)) { --$i; continue; }

            Review::factory()
                ->forProduct($product)
                ->forUser($user)
                ->create();
        }
    }
}
