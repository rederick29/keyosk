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
            Review::factory()
                ->forProduct(Product::all()->random())
                ->forUser(User::all()->random())
                ->create();
        }
    }
}
