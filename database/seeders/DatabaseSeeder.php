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
           AttributeTagSeeder::class,
           ColourTagSeeder::class,
           CompatibilityTagSeeder::class,
           ProductSeeder::class,
           UserSeeder::class,
           OrderSeeder::class,
           ReviewSeeder::class,
        ]);
    }
}
