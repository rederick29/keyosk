<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag\AttributeTag;
use App\Models\Tag\ColourTag;
use App\Models\Tag\CompatibilityTag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colourTags = ColourTag::factory()->count(10)->create();
        $attributeTags = AttributeTag::factory()->count(10)->create();
        $compatibilityTags = CompatibilityTag::factory()->count(10)->create();

        $products = Product::all();
        foreach ($products as $product) {
            $product->tags()->attach($colourTags->random(rand(1, 3))->pluck('tag_id'));
            $product->tags()->attach($attributeTags->random(rand(1, 3))->pluck('tag_id'));
            $product->tags()->attach($compatibilityTags->random(rand(1, 3))->pluck('tag_id'));
        }
    }
}
