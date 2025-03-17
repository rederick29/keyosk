<x-layouts.admin-layout currentPage="Products">
    <section class="w-full flex flex-col items-center">
        <section class="w-full h-fit py-5 px-5 flex flex-wrap items-center justify-center gap-5 bg-stone-100 dark:bg-zinc-900 text-zinc-800 dark:text-gray-400 rounded-lg" id="search">
            <x-util.button class="h-fit p-3 block lg:hidden w-full md:w-20 bg-stone-200 dark:bg-zinc-800"
                type="button">Filters
            </x-util.button>
            <x-util.search class="grow" placeholder="Search shop..." />
            <section class="w-fit flex flex-row flex-wrap justify-between gap-5" id="input-elements">
                <div class="w-full md:w-fit flex items-center justify-center flex-wrap gap-3">
                    <label class="hidden md:inline">Sort by</label>
                    <x-shop.select class="w-full md:w-64 h-full" id="sort-by">
                        <x-shop.option value="price_low_to_high">Stock: Low to High</x-shop.option>
                        <x-shop.option value="price_high_to_low">Stock: High to Low</x-shop.option>
                    </x-shop.select>
                </div>
            </section>
        </section>
        <div class="w-full py-5 flex flex-col gap-y-5">
            @foreach(\App\Models\Product::all()->sortBy('stock') as $product)
            <a href="{{ route('product.get.edit', ['productId' => $product->id]) }}">
                <div class="w-full bg-stone-100 dark:bg-zinc-900 rounded-md p-6 flex flex-row justify-between hover:ring-4 hover:ring-orange-500 dark:hover:ring-violet-700/75 transition-all duration-300">
                    <p class="font-semibold ml-1">{{$product->name}}</p>

                    @if($product->stock == 0)
                        <p class="w-32 p-1 flex justify-center bg-red-600 rounded-md font-bold text-white">OUT OF STOCK</p>
                    @elseif($product->stock <= 10)
                        <p class="w-32 p-1 flex justify-center bg-yellow-500 rounded-md font-bold text-white">{{$product->stock}} IN STOCK</p>
                    @else
                        <p class="w-32 p-1 flex justify-center bg-green-600 rounded-md font-bold text-white">{{$product->stock}} IN STOCK</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </section>
</x-layouts.admin-layout>
