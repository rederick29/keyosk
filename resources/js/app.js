import './bootstrap';
import '../ts/app.ts';

// This is for 'npm run build' so vite can find the images, helps with caching.
import.meta.glob([
    '../images/**'
]);

console.log("Connection");
