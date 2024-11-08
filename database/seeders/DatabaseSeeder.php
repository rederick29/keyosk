<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
