{{--
    product-card component.

    Author(s): Toms Xavi: Developer
--}}

<div class="product-card bg-stone-100 dark:bg-zinc-900 rounded-md p-6 flex flex-col gap-4 mb-6 relative hover:ring-4 hover:ring-orange-500 dark:hover:ring-violet-700/75 transition-all duration-300">
    <!-- Product Image and Info Container -->
    <div class="flex items-center gap-4">
        <!-- Clickable Element -->
        <a href="/product/{{ $productId }}" class="w-full h-2/3 bg-transparent absolute top-0 left-0"></a>
        <a href="/product/{{ $productId }}"
            class="hidden lg:block w-2/3 h-full bg-transparent absolute top-0 left-0"></a>

        <!-- Product Image -->
        <div class="product-image h-32 w-32 bg-stone-200 dark:bg-zinc-900 rounded-md flex items-center justify-center overflow-hidden">
            <img src="{{ $productImage ?? '#' }}" alt="{{ $productTitle }}"
                class="h-full w-full object-contain">
        </div>


        <!-- Product Details -->
        <div class="flex-grow">
            <h3 class="product-title text-lg font-semibold text-zinc-800 dark:text-white mb-2">{{ $productTitle }}</h3>
            <p class="product-description text-sm text-black/50 dark:text-gray-300 leading-relaxed">
                {{ $productShortDescription }}
            </p>
        </div>

        <!-- Price -->
        <div class="flex-shrink-0">
            <span class="product-price text-2xl font-bold text-zinc-800 dark:text-white">
                £{{ number_format($productPrice, 2) }}
                @if(Auth::user())
                    @if(Auth::user()->is_admin)
                        <p class="justify-self-start text-base text-white/70">Stock: {{$productStock}}</p>
                    @endif
                @endif
            </span>
        </div>
    </div>

    <!-- Quantity Selector and Buttons -->
    <div class="flex items-center justify-end gap-4 mt-4 ">
        <form method="POST" action="{{ route('cart.update') }}" id="product-buy-form-{{ $productId }}">
            @csrf

            <input type="hidden" id="cart_action" name="cart_action" value="{{ \App\Utils\CartUpdateAction::Add }}">
            <input type="hidden" id="product_id" name="product_id" value="{{ $productId }}">

            <!-- Quantity Selector -->
            <div class="flex items-center gap-2">
                <label for="quantity-{{ $productId }}" class="text-sm text-zinc-800 dark:text-gray-300">Qty:</label>
                <div class="flex items-center bg-white dark:bg-zinc-800 text-white rounded-md overflow-hidden">
                    <button type="button" id="decrease-quantity-{{ $productId }}"
                        class="w-8 h-8 flex items-center justify-center text-zinc-800 dark:text-gray-400  hover:text-zinc-700 dark:hover:text-white transition duration-200 bg-stone-200 dark:bg-zinc-700 hover:bg-stone-300 dark:hover:bg-zinc-600">
                        -
                    </button>
                    <input type="number" id="quantity-{{ $productId }}" name="quantity" min="1"
                        value="1"
                        class="w-12 h-8 text-center bg-transparent text-zinc-800 dark:text-white outline-none border-none">
                    <button type="button" id="increase-quantity-{{ $productId }}"
                        class="w-8 h-8 flex items-center justify-center text-zinc-800 dark:text-gray-400  hover:text-zinc-700 dark:hover:text-white transition duration-200 bg-stone-200 dark:bg-zinc-700 hover:bg-stone-300 dark:hover:bg-zinc-600">
                        +
                    </button>
                </div>

                <!-- Add to Cart Button -->
                <input type="hidden" id="product_id" name="product_id" value="{{ $productId }}">
                <button class="add-to-cart-btn-{{ $productId }} border border-orange-500 dark:border-violet-700 text-orange-500 dark:text-violet-700 px-5 py-2 rounded-md font-semibold hover:bg-orange-500 dark:hover:bg-violet-700 hover:text-zinc-800 dark:hover:text-white transition duration-300">
                    Add to Cart
                </button>
            </div>

        </form>

        <!-- Buy Now Button -->
        <button
            class="buy-now-btn-{{ $productId }} px-5 py-2 rounded-md font-semibold bg-orange-500 dark:bg-violet-700 text-zinc-800 dark:text-white hover:bg-orange-600 dark:hover:bg-violet-800">
            Buy Now
        </button>
    </div>
</div>

<script nonce="{{ csp_nonce() }}">
    document.addEventListener('DOMContentLoaded', function() {
        setupProductButtons('{{ $productId }}');
    });
</script>


<style>
    /* Styling for Quantity Selector */
    .quantity-selector input {
        appearance: none;
        /* Removes browser default styles */
        padding: 0.25rem 0;
        font-size: 1rem;
        text-align: center;
        /* Centers the text */
        height: 2rem;
        /* Adjusted height */
        width: 3rem;
        /* Adjusted width */
        margin: 0;
        /* Ensures no extra space inside input */
    }

    /* Prevents scroll arrows in the input for all browsers */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        /* Firefox */
        -webkit-appearance: none;
        /* Chrome, Safari */
        appearance: none;
        /* All other browsers */
    }

    /* Styling for Buttons */
    .add-to-cart-btn,
    .buy-now-btn {
        font-size: 1rem;
        font-weight: bold;
        padding: 0.75rem 1.5rem;
        /* Ensure equal padding */
        height: 2.75rem;
        /* Adjust the height of the buttons to be equal */
        min-width: 8rem;
        /* Ensure buttons have the same minimum width */
        text-align: center;
        /* Center the text inside */
        display: inline-flex;
        justify-content: center;
        /* Center the content horizontally */
        align-items: center;
        /* Center the content vertically */
        transition: all 0.3s ease;
    }

    .product-image {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 8rem; /* Fixed width */
    height: 8rem; /* Fixed height */
    overflow: hidden; /* Prevents overflow */
    border-radius: 0.5rem; /* Rounded edges */
    background-color: #f5f5f5; /* Light background */
    }

    .product-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* Ensures full image fits without cropping */
    }

</style>
