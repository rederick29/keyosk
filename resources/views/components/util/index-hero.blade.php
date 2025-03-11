{{--
    Image carousel element with split layout.

    Author(s): Ben Snaith : Main Developer, Arun : Secondary Developer
--}}

<section class="w-full min-h-[30vh] pt-24 flex items-center bg-linear-to-tr from-orange-500 to-red-500 dark:from-violet-500 dark:to-pink-500" id="image-scroll">
    <!-- Left side - Shop Now text (1/4 width) -->
    {{-- <div class="w-1/4 h-full flex items-center justify-center">
        <div class="flex flex-col items-center text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Shop Now</h2>
            <a href="/shop" class="px-6 py-3 rounded-lg backdrop-blur-md bg-white/20 dark:bg-black/20 border border-white/30 dark:border-white/10 text-white font-semibold shadow-lg hover:bg-white/30 dark:hover:bg-black/30 transition duration-300 ease-in-out">
                Browse Products
            </a>
        </div>
    </div> --}}

    <!-- Right side - Image carousel (3/4 width) -->
    <div class="w-full h-1/2 mx-auto">
        <div class="flex flex-col anim-right">
            <canvas id="canvas" class="h-full w-full">

            </canvas>

            @vite('resources/ts/index-hero.ts')
        </div>
    </div>
</section>
