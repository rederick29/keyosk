<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            Wishlist::factory()
                ->forUser($user)
                ->forProducts(Product::all()->random(random_int(0, 10)))
                ->create();
        }
    }
}
