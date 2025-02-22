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
        $this->colour_tags();
        $this->attribute_tags();
    }

    private function colour_tags(): void
    {
        $colours = [
            'black' => '#000000',
            'white' => '#ffffff',
            'red' => '#ff0000',
            'green' => '#00ff00',
            'blue' => '#0000ff',
            'yellow' => '#ffff00',
            'pink' => '#ff69ff',
        ];

        foreach ($colours as $name => $hex_code) {
            ColourTag::factory()->withName($name)->create(compact('hex_code'));
        }
    }

    private function attribute_tags(): void
    {
        $attributes = [
            'gaming' => 'High-performance gaming item',
            'rgb' => 'Product has customisable rgb lighting features',
            'keyboard' => 'A keyboard item',
            'full_size' => 'Full size item',
            'braille' => 'Braille input for visually impaired users',
            '60%' => '60% size compact keyboard',
            '65%' => '65% size compact keyboard',
            '70%' => '70% size compact keyboard',
            '75%' => '75% size compact keyboard',
            'mechanical' => 'Product uses high-quality mechanical switches',
            'mouse' => 'A mouse item',
            'wireless' => 'Wireless peripherals',
            'mousepad' => 'A mousepad item',
            'keycaps' => 'Keyboard key caps',
            'key_switches' => 'Keyboard key switches',
            'small' => 'Small size',
            'medium' => 'Medium size',
            'large' => 'Large size',
        ];

        foreach ($attributes as $name => $description) {
            AttributeTag::factory()->withName($name)->create(compact('description'));
        }
    }
}
