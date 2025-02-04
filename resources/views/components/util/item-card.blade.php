{{-- Item Card Component --}}
@props([
    'id' => null,
    'image' => null,
    'alt' => 'Product Image',
    'title' => 'No Title',
    'description' => 'No description available.',
    'price' => 0.00
])

<div class="relative w-72 h-[350px] bg-stone-200 dark:bg-zinc-900 text-white rounded-lg shadow-lg overflow-hidden transform transition-transform hover:scale-105 flex flex-col border-2 border-orange-500 dark:border-violet-700 cursor-pointer group">
    
    <!-- Clickable overlay to go to product page -->
    <a href="{{ $id ? route('product.view', ['id' => $id]) : '#' }}" class="absolute inset-0 z-10"></a>

    <!-- Product Image -->
    <div class="bg-stone-300 dark:bg-black flex justify-center items-center py-6">
        <img src="{{ $image ? asset('storage/' . $image) : asset('images/placeholder.jpg') }}" 
             alt="{{ $alt }}" 
             class="h-20 object-contain">
    </div>

    <!-- Product Info -->
    <div class="px-4 py-3 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold mb-2 text-center text-zinc-800 dark:text-white">
            {{ $title }}
        </h3>
        <p class="text-sm mb-3 text-center text-zinc-800 dark:text-zinc-400">
            {{ $description }}
        </p>
    </div>

    <!-- Centered Add to Cart Button & Price -->
    <div class="px-4 py-3 flex flex-col items-center justify-center flex-grow gap-3 z-20 text-center">
        
        <form method="POST" action="{{ route('cart.add') }}" class="w-full flex justify-center">
            @csrf
            <input type="hidden" name="product_id" value="{{ $id }}">
            <input type="hidden" name="quantity" value="1">

            <button type="submit"
                class="add-to-cart-btn border border-orange-500 dark:border-violet-700 text-orange-500 dark:text-violet-700 px-5 py-2 rounded-md font-semibold hover:bg-orange-500 dark:hover:bg-violet-700 hover:text-zinc-800 dark:hover:text-white transition duration-300">
                Add to Cart
            </button>
        </form>

        <p class="text-md font-bold text-zinc-800 dark:text-white">
            £{{ number_format((float)$price, 2) }}
        </p>
    </div>
</div>
