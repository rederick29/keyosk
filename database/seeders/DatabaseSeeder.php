<?php
namespace Database\Seeders;

use App\Models\ColourTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

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
