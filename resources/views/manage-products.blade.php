<x-layouts.admin-layout currentPage="Products">
    <section class="w-11/12 py-10 flex flex-col items-center">
        <div class="w-full h-fit py-5 px-5 flex justify-center gap-x-5 bg-stone-100 dark:bg-zinc-900 text-zinc-800 dark:text-gray-400 rounded-lg">
            <x-util.search class="w-full" placeholder="Search Products" />
            <x-util.button type="a" href="/admin/manage-products/add" class="w-1/5 h-full self-center bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">Add Product</x-util.button>
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
