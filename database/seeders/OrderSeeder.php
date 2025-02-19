<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::all() as $user) {
            Order::factory()
                ->count(random_int(2, 10))
                ->forUser($user)
                ->forProducts(Product::all()->random(random_int(1, 5)), random_int(1, 5))
                ->create();
        }
    }
}
