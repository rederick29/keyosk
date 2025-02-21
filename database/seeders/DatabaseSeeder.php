<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            ProductSeeder::class,
            TagSeeder::class,
            ImageSeeder::class,
            UserSeeder::class,
            CartSeeder::class,
            ReviewSeeder::class,
            AddressSeeder::class,
            OrderSeeder::class,
            WishlistSeeder::class,
            VoucherSeeder::class,
            SubscriptionSeeder::class,
        ]);
    }
}
