<x-layouts.layout>
    <x-slot:title>Keyosk | Shop</x-slot:title>

    <main class="w-full h-fit flex justify-center pt-32 pb-[32px]">
        <div class="px-5 w-full lg:w-4/5 h-full flex flex-row justify-center space-x-5">
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
                        <x-util.product-card :product="$product" :p_product="$product"/>
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
