import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

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
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/cart-menu.js', 'resources/js/navbar.js'],
            refresh: true,
        }),
    ],
});
