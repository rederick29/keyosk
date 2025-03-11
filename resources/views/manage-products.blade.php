<x-layouts.admin-layout currentPage="Products">
    <section class="w-full flex flex-col items-center">
        <div
            class="w-full h-fit py-5 px-5 flex justify-center bg-stone-100 dark:bg-zinc-900 text-zinc-800 dark:text-gray-400 rounded-lg"
            id="search"
        >
            <x-util.search class="w-full" placeholder="Search Products" />
        </div>
        <div class="w-full py-5 flex flex-col gap-y-5">
            @foreach(\App\Models\Product::all() as $product)
            <a href="{{ route('product.get.edit', ['productId' => $product->id]) }}">
                <div class="w-full bg-stone-100 dark:bg-zinc-900 rounded-md p-6 flex flex-col hover:ring-4 hover:ring-orange-500 dark:hover:ring-violet-700/75 transition-all duration-300">
                    <p class="font-semibold ml-1">{{$product->name}}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>
</x-layouts.admin-layout>
