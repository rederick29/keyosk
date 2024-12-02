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
        if (App::isProduction()) {
            $this->call([UserSeeder::class]);
            return;
        }

        $this->call([
            ProductSeeder::class,
            TagSeeder::class,
            ImageSeeder::class,
            UserSeeder::class,
            CartSeeder::class,
            OrderSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
