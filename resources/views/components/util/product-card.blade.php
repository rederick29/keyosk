{{--
    product cards element.

    Author(s): Toms Xavi : Developer
--}}

<div class="product-card border-2 border-purple-500 rounded-lg p-4 bg-black text-white">
    <div class="product-image h-24 w-full bg-gray-800 rounded mb-4"></div>
    <h3 class="product-title text-lg font-bold mb-2">{{ $title }}</h3>
    <p class="product-description text-sm text-gray-300 mb-4">{{ $description }}</p>
    <div class="flex justify-between items-center">
        <span class="product-price text-xl font-semibold">{{ $price }}</span>
        <button class="buy-button bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg transition duration-200">
            Buy
        </button>
    </div>
</div>