<x-layouts.layout>
    <x-slot:title>Keyosk | Shop</x-slot:title>

    <main class="w-full h-fit flex justify-center pt-32 pb-[32px]">
        <div class="w-full lg:w-4/5 h-full flex flex-row justify-center space-x-5">
            <aside class="w-96 h-fit flex flex-col gap-4">

                <!-- Keyosk+ -->
                <div class="h-64 p-6 flex flex-col justify-between bg-stone-200 dark:bg-zinc-900 rounded-lg">
                    <h1 class="text-xl font-bold">Harness the power of true typing proficiency</h1>

                    <a href="/keyosk-plus" class="text-violet-500 hover:underline cursor-pointer">Get more from Keyosk with <span class="font-bold">Keyosk+</span></a>
                </div>

                <!-- Tags and Filters -->
                <div class="p-4 bg-stone-200 dark:bg-zinc-900 rounded-lg">
                    <x-accordion.accordion label="Category" class="w-full">
                        <x-accordion.accordion-item :filter="'keyboard'" class="relative flex items-center justify-between accordion-tick-unselected">
                            Keyboard
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'mouse'" class="relative flex items-center justify-between accordion-tick-unselected">
                            Mice
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'key_switches'" class="relative flex items-center justify-between accordion-tick-unselected">
                            Switches
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'keycaps'" class="relative flex items-center justify-between accordion-tick-unselected">
                            Keycaps
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'mousepad'" class="relative flex items-center justify-between accordion-tick-unselected">
                            Mousepads
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                    </x-accordion.accordion>
                </div>

                <div class="p-4 bg-stone-200 dark:bg-zinc-900 rounded-lg">
                    <x-accordion.accordion label="Color">
                        <x-accordion.accordion-item :filter="'black'" class="relative flex items-center justify-between accordion-tick-unselected">
                            Black
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'white'" class="relative flex items-center justify-between accordion-tick-unselected">
                            White
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'red'" class="relative flex items-center justify-between accordion-tick-unselected">
                            Red
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'green'" class="relative flex items-center justify-between accordion-tick-unselected">
                            Green
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'blue'" class="relative flex items-center justify-between accordion-tick-unselected">
                            Blue
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'rgb'" class="relative flex items-center justify-between accordion-tick-unselected">
                            RGB
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                    </x-accordion.accordion>
                </div>

                <div class="p-4 bg-stone-200 dark:bg-zinc-900 rounded-lg">
                    <x-accordion.accordion label="Size">
                        <x-accordion.accordion-item :filter="'large'" class="relative flex items-center justify-between accordion-tick-unselected">
                            Large
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'medium'" class="relative flex items-center justify-between accordion-tick-unselected">
                            Medium
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'small'" class="relative flex items-center justify-between accordion-tick-unselected">
                            Small
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'full_size'" class="relative flex items-center justify-between accordion-tick-unselected">
                            100%
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'75%'" class="relative flex items-center justify-between accordion-tick-unselected">
                            75%
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'70%'" class="relative flex items-center justify-between accordion-tick-unselected">
                            70%
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'65%'" class="relative flex items-center justify-between accordion-tick-unselected">
                            65%
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'60%'" class="relative flex items-center justify-between accordion-tick-unselected">
                            60%
                            <svg class="tick absolute right-2 transition" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <svg class="cross absolute right-2 transition text-red-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </x-accordion.accordion-item>
                    </x-accordion.accordion>
                </div>
            </aside>

            <div class="w-full h-full flex flex-col space-y-5">
                <section
                    class="w-full h-fit py-5 px-5 flex flex-wrap items-center justify-center gap-5 bg-stone-100 dark:bg-zinc-900 text-zinc-800 dark:text-gray-400 rounded-lg"
                    id="search">
                    <x-util.button class="h-fit p-3 block lg:hidden w-full md:w-20 bg-stone-200 dark:bg-zinc-800"
                        type="button">Filters
                    </x-util.button>
                    <x-util.search class="grow" placeholder="Search shop..." />
                    <section class="w-fit flex flex-row flex-wrap justify-between gap-5" id="input-elements">
                        <div class="w-full md:w-fit flex items-center justify-center flex-wrap gap-3">
                            <label class="hidden md:inline">Sort by</label>
                            <x-shop.select class="w-full md:w-64 h-full" id="sort-by">
                                <x-shop.option value="date">New</x-shop.option>
                                <x-shop.option value="best_selling">Best Selling</x-shop.option>
                                <x-shop.option value="price_low_to_high">Price: Low to High</x-shop.option>
                                <x-shop.option value="price_high_to_low">Price: High to Low</x-shop.option>
                            </x-shop.select>
                        </div>
                        <div class="flex items-center justify-center flex-wrap gap-3">
                            <label>Show per page</label>
                            <x-shop.select class="w-20 h-full" id="results-per-page">
                                <x-shop.option value="10">10</x-shop.option>
                                <x-shop.option value="25">25</x-shop.option>
                                <x-shop.option value="50">50</x-shop.option>
                            </x-shop.select>
                        </div>
                    </section>
                </section>

                <section id="filters-display" class="hidden flex-wrap gap-2">
                    <x-util.button type="button" id="clear-filters" class="w-fit h-fit p-2 flex items-center gap-2 bg-stone-200 hover:bg-stone-300 dark:bg-zinc-900 dark:hover:bg-zinc-800 rounded-lg cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"/></svg>
                        Clear All Filters
                    </x-util.button>
                </section>

                <section class="w-full h-fit rounded-md" id="results">
                    @vite('resources/ts/product-buttons.ts')
                    @foreach ($products as $product)
                        <x-util.product-card :product="$product" />
                    @endforeach

                    <div>
                        {{ $products->links() }}
                    </div>
                </section>
            </div>
        </div>
    </main>
</x-layouts.layout>
@vite('resources/ts/shop-search.ts')
