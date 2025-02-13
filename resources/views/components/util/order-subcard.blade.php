<div class="bg-stone-100 dark:bg-zinc-900 border-2 border-orange-500 dark:border-violet-700 rounded-md p-6 flex flex-col gap-2 shadow-lg mb-3 mx-5">
    <div class="product-image h-20 w-20 bg-stone-200 dark:bg-gray-800 rounded-md flex items-center justify-center overflow-hidden">
        <img src="{{ $prodimg ?? '#' }}" alt="" class="h-full w-full object-cover">
    </div>
    <h2 class="font-bold">{{ $productname }}</h2>
    <p>{{ $desc }}&emsp;{{ $prodprice }}</p>
</div>
