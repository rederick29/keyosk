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
<div class="w-[800px] h-[360px] flex flex-row bg-stone-200 dark:bg-zinc-900 rounded-md overflow-hidden transform transition duration-300 relative">

    <!-- Product Image -->
    <div class="w-2/4 bg-stone-300 dark:bg-black flex justify-center items-center py-3">
        <img src="{{ $image ? $image : asset('images/placeholder.jpg') }}"
             alt="{{ $alt }}"
             class="h-24 w-auto object-contain">
    </div>

    <!-- Product Info -->
    <section class="w-2/3 p-5 flex flex-col justify-between">
        <div class="flex flex-col">
            <!-- Title with spacing -->
            <h3 class="text-2xl font-semibold text-zinc-800 dark:text-white mt-2 whitespace-nowrap overflow-hidden text-ellipsis">
                {{ $title }}
            </h3>

            <!-- Price moved between description & button -->
            <p class="text-xl font-bold text-zinc-800 dark:text-white mt-4">
                £{{ number_format((float)$price, 2) }}
            </p>

            <!-- Description with ellipsis for long text -->
            <p class="text-sm text-black/50 dark:text-gray-300 mt-3 line-clamp-10 overflow-hidden text-ellipsis">
                {{ $description }}
            </p>
        </div>

        <!-- Centered Add to Cart Button -->
        <div class="flex flex-col items-center ">
            <form method="POST" action="{{ route('cart.update') }}" class="w-full flex justify-center">
                @csrf
                <input type="hidden" name="cart_action" value="{{ \App\Utils\CartUpdateAction::Add }}">
                <input type="hidden" name="product_id" value="{{ $id }}">
                <input type="hidden" name="quantity" value="1">

                <x-util.button type="button" class="bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">
                    Add to Cart
                </x-util.button>
            </form>
        </div>
    </section>
</div>
