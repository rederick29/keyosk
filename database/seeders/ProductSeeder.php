<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Keyboards
            [
                'name' => 'Keyosk Standard Keyboard',
                'short_description' => 'A basic keyboard, ideal for novice computer users.',
                'price' => 29.99,
                'images' => [['location' => 'images/db/standard_keyboard.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Braille Keyboard',
                'short_description' => 'A keyboard suitable for visually impaired individuals.',
                'price' => 59.99,
                'images' => [['location' => 'images/db/braille_keyboard.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Mercury 60% Keyboard',
                'short_description' => 'A compact 60% keyboard with responsive linear key switches, perfect for gamers.',
                'price' => 129.99,
                'images' => [['location' => 'images/db/mercury_60_keyboard.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Daybreak 65% Keyboard',
                'short_description' => 'A sleek 65% keyboard with MX Brown switches and RGB lighting.',
                'price' => 119.99,
                'images' => [['location' => 'images/db/daybreak_65_keyboard.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk A75 Pro Keyboard',
                'short_description' => 'A 75% mechanical keyboard with magnetic switches, RGB lighting, and adjustable knob.',
                'price' => 119.99,
                'images' => [['location' => 'images/db/a75_pro_keyboard.png', 'priority' => 0]],
            ],

            // Mice
            [
                'name' => 'Keyosk Standard Mouse',
                'short_description' => 'A basic mouse, ideal for novice computer users.',
                'price' => 10.99,
                'images' => [['location' => 'images/db/standard_mouse.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Wireless Optical Mouse',
                'short_description' => 'An easily portable 2.4GHz battery powered wireless mouse.',
                'price' => 24.99,
                'images' => [['location' => 'images/db/wireless_optical_mouse.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Heart Mouse',
                'short_description' => 'A novelty red heart wired mouse, ideal for a fun user.',
                'price' => 29.99,
                'images' => [['location' => 'images/db/heart_mouse.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Aurora Mouse',
                'short_description' => 'A wired gaming mouse with RGB LEDs and precise optical tracking, ideal for avid gamers.',
                'price' => 44.99,
                'images' => [['location' => 'images/db/aurora_mouse.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Vortex Mouse',
                'short_description' => 'A wired gaming mouse with optical tracking and customizable RGB lighting.',
                'price' => 59.99,
                'images' => [['location' => 'images/db/vortex_mouse.png', 'priority' => 0]],
            ],

            // Mousepads
            [
                'name' => 'Keyosk Black Cat Mousepad',
                'short_description' => 'A mid-large 90cm x 50cm mousepad, with a dark themed cat design.',
                'price' => 35.99,
                'images' => [['location' => 'images/db/black_cat_mousepad.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Bounty Hunter Mousepad',
                'short_description' => 'A large 100cm x 50cm mousepad, with a design inspired by The Mandalorian®.',
                'price' => 43.99,
                'images' => [['location' => 'images/db/bounty_hunter_mousepad.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Odyssey Mousepad',
                'short_description' => 'A large 100cm x 50cm mousepad, with a dark space themed design.',
                'price' => 43.99,
                'images' => [['location' => 'images/db/odyssey_mousepad.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Expedition Mousepad',
                'short_description' => 'A medium 80cm x 40cm mousepad, with a snowy mountain design.',
                'price' => 27.99,
                'images' => [['location' => 'images/db/expedition_mousepad.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Ocean Mosaic Mousepad',
                'short_description' => 'A medium 80cm x 40cm mousepad, with a calm blue pattern design.',
                'price' => 27.99,
                'images' => [['location' => 'images/db/ocean_mosaic_mousepad.png', 'priority' => 0]],
            ],

            // Keycaps
            [
                'name' => 'Keyosk Hornet WASD Key Caps',
                'short_description' => 'WASD keys in yellow, great durability and grip.',
                'price' => 9.99,
                'images' => [['location' => 'images/db/hornet_wasd_key_caps.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Scarlet WASD Key Caps',
                'short_description' => 'WASD keys in red, great durability and grip.',
                'price' => 9.99,
                'images' => [['location' => 'images/db/scarlet_wasd_key_caps.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Raven Key Caps',
                'short_description' => 'WASD in white, great durability and grip.',
                'price' => 9.99,
                'images' => [['location' => 'images/db/raven_key_caps.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk State Linux Key Caps',
                'short_description' => '1 Esc, 1 Ctrl, 1 Caps Lock, 2 Tux. Perfect for Linux.',
                'price' => 18.99,
                'images' => [['location' => 'images/db/slate_linux_key_caps.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk RGB ISO Key Caps',
                'short_description' => '2 Shift keys, 2 Ctrl keys, 2 Alt keys in green, red and blue.',
                'price' => 18.99,
                'images' => [['location' => 'images/db/rgb_iso_key_caps.png', 'priority' => 0]],
            ],

            // Key Switches
            [
                'name' => 'Keyosk Alpaca Key Switches',
                'short_description' => 'Incredibly smooth switches, lightly lubricated for great typing.',
                'price' => 5.99,
                'images' => [['location' => 'images/db/alpaca_key_switches.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Silent Alpaca Key Switches',
                'short_description' => 'Similar to Alpacas, but very quiet for noise-sensitive users.',
                'price' => 8.99,
                'images' => [['location' => 'images/db/silent_alpaca_key_switches.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk T1 Tactile Key Switches',
                'short_description' => 'High quality tactile switches, factory lubed for smoothness.',
                'price' => 5.99,
                'images' => [['location' => 'images/db/t1_tactile_key_switches.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Silent Dawn Key Switches',
                'short_description' => '6dB silent linear switches, dampened for smooth typing.',
                'price' => 7.99,
                'images' => [['location' => 'images/db/silent_dawn_key_switches.png', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Dark Rose Key Switches',
                'short_description' => 'Unique housing design reduces wobble, has detachable light column.',
                'price' => 5.99,
                'images' => [['location' => 'images/db/dark_rose_key_switches.png', 'priority' => 0]],
            ]
        ];

        foreach ($products as $productData) {
            $product = Product::factory()->create([
                'name' => $productData['name'],
                'short_description' => $productData['short_description'],
                'price' => $productData['price'],
            ]);

            $product->images()->createMany($productData['images']);
        }
    }
}
