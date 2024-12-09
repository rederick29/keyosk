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
                'description' => 'A basic keyboard, ideal for novice computer users.',
                'price' => 29.99,
                'images' => [['location' => 'standard_keyboard.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Braille Keyboard',
                'description' => 'A keyboard suitable for visually impaired individuals.',
                'price' => 59.99,
                'images' => [['location' => 'braille_keyboard.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Mercury 60% Keyboard',
                'description' => 'A compact 60% keyboard with responsive linear key switches, perfect for gamers.',
                'price' => 129.99,
                'images' => [['location' => 'mercury_60_keyboard.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Daybreak 65% Keyboard',
                'description' => 'A sleek 65% keyboard with MX Brown switches and RGB lighting.',
                'price' => 119.99,
                'images' => [['location' => 'daybreak_65_keyboard.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk A75 Pro Keyboard',
                'description' => 'A 75% mechanical keyboard with magnetic switches, RGB lighting, and adjustable knob.',
                'price' => 119.99,
                'images' => [['location' => 'a75_pro_keyboard.jpg', 'priority' => 0]],
            ],

            // Mice
            [
                'name' => 'Keyosk Standard Mouse',
                'description' => 'A basic mouse, ideal for novice computer users.',
                'price' => 10.99,
                'images' => [['location' => 'standard_mouse.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Wireless Optical Mouse',
                'description' => 'An easily portable 2.4GHz battery powered wireless mouse.',
                'price' => 24.99,
                'images' => [['location' => 'wireless_optical_mouse.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Heart Mouse',
                'description' => 'A novelty red heart wired mouse, ideal for a fun user.',
                'price' => 29.99,
                'images' => [['location' => 'heart_mouse.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Aurora Mouse',
                'description' => 'A wired gaming mouse with RGB LEDs and precise optical tracking, ideal for avid gamers.',
                'price' => 44.99,
                'images' => [['location' => 'aurora_mouse.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Vortex Mouse',
                'description' => 'A wired gaming mouse with optical tracking and customizable RGB lighting.',
                'price' => 59.99,
                'images' => [['location' => 'vortex_mouse.jpg', 'priority' => 0]],
            ],

            // Mousepads
            [
                'name' => 'Keyosk Black Cat Mousepad',
                'description' => 'A mid-large 90cm x 50cm mousepad, with a dark themed cat design.',
                'price' => 35.99,
                'images' => [['location' => 'black_cat_mousepad.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Bounty Hunter Mousepad',
                'description' => 'A large 100cm x 50cm mousepad, with a design inspired by The Mandalorian®.',
                'price' => 43.99,
                'images' => [['location' => 'bounty_hunter_mousepad.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Odyssey Mousepad',
                'description' => 'A large 100cm x 50cm mousepad, with a dark space themed design.',
                'price' => 43.99,
                'images' => [['location' => 'odyssey_mousepad.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Expedition Mousepad',
                'description' => 'A medium 80cm x 40cm mousepad, with a snowy mountain design.',
                'price' => 27.99,
                'images' => [['location' => 'expedition_mousepad.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Ocean Mosaic Mousepad',
                'description' => 'A medium 80cm x 40cm mousepad, with a calm blue pattern design.',
                'price' => 27.99,
                'images' => [['location' => 'ocean_mosaic_mousepad.jpg', 'priority' => 0]],
            ],

            // Keycaps
            [
                'name' => 'Keyosk Hornet WASD Key Caps',
                'description' => 'WASD keys in yellow, great durability and grip.',
                'price' => 9.99,
                'images' => [['location' => 'hornet_wasd_key_caps.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Scarlet WASD Key Caps',
                'description' => 'WASD keys in red, great durability and grip.',
                'price' => 9.99,
                'images' => [['location' => 'scarlet_wasd_key_caps.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Raven Key Caps',
                'description' => 'WASD in white, great durability and grip.',
                'price' => 9.99,
                'images' => [['location' => 'raven_key_caps.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk State Linux Key Caps',
                'description' => '1 Esc, 1 Ctrl, 1 Caps Lock, 2 Tux. Perfect for Linux.',
                'price' => 18.99,
                'images' => [['location' => 'state_linux_key_caps.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk RGB ISO Key Caps',
                'description' => '2 Shift keys, 2 Ctrl keys, 2 Alt keys in green, red and blue.',
                'price' => 18.99,
                'images' => [['location' => 'rgb_iso_key_caps.jpg', 'priority' => 0]],
            ],

            // Key Switches
            [
                'name' => 'Keyosk Alpaca Key Switches',
                'description' => 'Incredibly smooth switches, lightly lubricated for great typing.',
                'price' => 5.99,
                'images' => [['location' => 'alpaca_key_switches.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Silent Alpaca Key Switches',
                'description' => 'Similar to Alpacas, but very quiet for noise-sensitive users.',
                'price' => 8.99,
                'images' => [['location' => 'silent_alpaca_key_switches.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk T1 Tactile Key Switches',
                'description' => 'High quality tactile switches, factory lubed for smoothness.',
                'price' => 5.99,
                'images' => [['location' => 't1_tactile_key_switches.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Silent Dawn Key Switches',
                'description' => '6dB silent linear switches, dampened for smooth typing.',
                'price' => 7.99,
                'images' => [['location' => 'silent_dawn_key_switches.jpg', 'priority' => 0]],
            ],
            [
                'name' => 'Keyosk Dark Rose Key Switches',
                'description' => 'Unique housing design reduces wobble, has detachable light column.',
                'price' => 5.99,
                'images' => [['location' => 'dark_rose_key_switches.jpg', 'priority' => 0]],
            ]
        ];

        foreach ($products as $productData) {
            $product = Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
            ]);

            $product->images()->createMany($productData['images']);
        }
    }
}
