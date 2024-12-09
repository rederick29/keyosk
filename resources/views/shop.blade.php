<x-layouts.layout>
    <x-slot:title>Keyosk | Shop</x-slot:title>

    <main class="w-full h-fit flex justify-center pt-32 pb-[32px]">
        <div class="px-5 w-full lg:w-4/5 h-full flex flex-row justify-center space-x-5">

            <!--
                Here there will be an aside with filters etc. but this has been removed for the sake of completing MVP
            -->

            <div class="w-full h-full flex flex-col space-y-5">
                <section
                    class="w-full h-fit py-5 px-5 flex flex-wrap items-center justify-center gap-5 bg-stone-200 dark:bg-zinc-900  text-zinc-800 dark:text-gray-400 rounded-lg"
                    id="search">
                    <x-util.button class="h-fit p-3 block lg:hidden w-20 bg-zinc-800" type="button">Filters
                    </x-util.button>
                    <x-util.search class="grow" placeholder="Search shop..." />
                    <section class="w-fit flex flex-row flex-wrap justify-between gap-5" id="input-elements">
                        <div class="flex items-center justify-center flex-wrap gap-3">
                            <label>Sort by</label>
                            <x-shop.select class="w-64 h-full bg-stone-300" id="sort-by">
                                <x-shop.option>Best Selling</x-shop.option>
                                <x-shop.option>New</x-shop.option>
                                <x-shop.option>Price: Low to High</x-shop.option>
                                <x-shop.option>Price: High to Low</x-shop.option>
                            </x-shop.select>
                        </div>
                        <div class="flex items-center justify-center flex-wrap gap-3">
                            <label>Show per page</label>
                            <x-shop.select class="w-20 h-full bg-stone-300" id="results-per-page">
                                <x-shop.option>20</x-shop.option>
                                <x-shop.option>30</x-shop.option>
                                <x-shop.option>40</x-shop.option>
                            </x-shop.select>
                        </div>
                    </section>
                </section>
                <section class="w-full h-fit rounded-md" id="results">
                    @foreach ($products as $product)
                        <x-util.product-card title="{{ $product->name }}" description="{{ $product->description }}"
                            price="{{ $product->price }}" id="{{ $product->id }}"></x-util.product-card>
                    @endforeach

                    <div>
                        {{ $products->links() }}
                    </div>
                </section>
            </div>
        </div>
    </main>
</x-layouts.layout>
