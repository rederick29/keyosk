<x-layouts.layout>
    <x-slot:title>Keyosk | Shop</x-slot:title>

    <main class="w-full h-fit flex justify-center pt-32 pb-[32px]">
        <div class="w-full lg:w-4/5 h-full flex flex-row justify-center space-x-5">
            <aside class="w-96 h-fit flex flex-col gap-4">

                <!-- Keyosk+ -->
                <div class="h-64 p-6 flex flex-col justify-between bg-zinc-900 rounded-lg">
                    <h1 class="text-xl font-bold">Harness the power of true typing proficiency</h1>

                    <p class="text-violet-500 hover:underline cursor-pointer">Get more from Keyosk with <span class="font-bold">Keyosk+</span></p>
                </div>

                <!-- Tags and Filters -->
                <div class="p-4 bg-zinc-900 rounded-lg">
                    <x-accordion.accordion label="Category" class="w-full">
                        <x-accordion.accordion-item :filter="'keyboard'">Keyboard</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'mouse'">Mice</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'key_switches'">Switches</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'keycaps'">Keycaps</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'mousepad'">Mousepads</x-accordion.accordion-item>
                    </x-accordion.accordion>
                </div>

                <div class="p-4 bg-zinc-900 rounded-lg">
                    <x-accordion.accordion label="Color">
                        <x-accordion.accordion-item :filter="'black'">Black</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'white'">White</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'red'">Red</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'green'">Green</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'blue'">Blue</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'rgb'">RGB</x-accordion.accordion-item>
                    </x-accordion.accordion>
                </div>

                <div class="p-4 bg-zinc-900 rounded-lg">
                    <x-accordion.accordion label="Size">
                        <x-accordion.accordion-item :filter="'large'">Large</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'medium'">Medium</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'small'">Small</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'full_size'">100%</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'75%'">75%</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'70%'">70%</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'65%'">65%</x-accordion.accordion-item>
                        <x-accordion.accordion-item :filter="'60%'">60%</x-accordion.accordion-item>
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
