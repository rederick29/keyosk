import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    resolve: {
        alias: {
            "@": '/resources',
            "@js": '/resources/js',
            "@ts": '/resources/ts',
            "@css": '/resources/css',
        }
    },
    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/cart-menu.js', 'resources/js/navbar.js', 'resources/ts/shop-search.ts', 'resources/ts/product-buttons.ts', 'resources/ts/checkout.ts', 'resources/ts/orders.ts', 'resources/ts/carousel.ts', 'resources/ts/index-hero.ts', 'resources/ts/admin-stats.ts'],
            refresh: true,
        }),
    ],
});
