{{--
Author(s): Toms Xavi : Developer
Item Card Component --}}


@props([
    'id' => null,
    'image' => null,
    'alt' => 'Product Image',
    'title' => 'No Title',
    'description' => 'No description available.',
    'price' => 0.00
])

<div class="relative w-72 h-[360px] bg-stone-200 dark:bg-zinc-900 text-white rounded-lg shadow-lg overflow-hidden transform transition-transform hover:scale-105 flex flex-col border-2 border-orange-500 dark:border-violet-700 cursor-pointer group">

    <!-- Clickable overlay to go to product page -->
    <a href="{{ $id ? route('product.view', ['id' => $id]) : '#' }}" class="absolute inset-0 z-10"></a>

    <!-- Product Image -->
    <div class="bg-stone-300 dark:bg-black flex justify-center items-center py-3">
        <img src="{{ $image ? $image : asset('images/placeholder.jpg') }}"
             alt="{{ $alt }}"
             class="h-24 w-auto object-contain">
    </div>

    <!-- Product Info -->
    <div class="px-4 py-2 flex flex-col flex-grow text-center">
        <!-- Title with spacing -->
        <h3 class="text-lg font-semibold text-zinc-800 dark:text-white mt-2 whitespace-nowrap overflow-hidden text-ellipsis">
            {{ $title }}
        </h3>

        <!-- Description with ellipsis for long text -->
        <p class="text-sm text-zinc-800 dark:text-zinc-400 mt-3 line-clamp-2 overflow-hidden text-ellipsis">
            {{ $description }}
        </p>

        <!-- Price moved between description & button -->
        <p class="text-md font-bold text-zinc-800 dark:text-white mt-4">
            £{{ number_format((float)$price, 2) }}
        </p>
    </div>

    <!-- Centered Add to Cart Button -->
    <div class="px-4 py-2 flex flex-col items-center justify-end flex-grow z-20 text-center">
        <form method="POST" action="{{ route('cart.update') }}" class="w-full flex justify-center">
            @csrf
            <input type="hidden" name="cart_action" value="{{ \App\Utils\CartUpdateAction::Add }}">
            <input type="hidden" name="product_id" value="{{ $id }}">
            <input type="hidden" name="quantity" value="1">

            <button type="submit"
                class="add-to-cart-btn w-full border border-orange-500 dark:border-violet-700 text-orange-500 dark:text-violet-700 px-5 py-2 rounded-md font-semibold hover:bg-orange-500 dark:hover:bg-violet-700 hover:text-zinc-800 dark:hover:text-white transition duration-300">
                Add to Cart
            </button>
        </form>
    </div>
</div>
