{{--
    product-card component.

    Author(s): Toms Xavi: Developer
--}}


<div class="product-card bg-zinc-900 rounded-md p-6 flex flex-col gap-4 mb-6 relative hover:ring-4 hover:ring-violet-700/75 transition-all duration-300">
    <!-- Product Image and Info Container -->
    <div class="flex items-center gap-4">
        <!-- Clickable Element -->
        <a href="/product/{{ $id }}" class="w-full h-2/3 bg-transparent absolute top-0 left-0"></a>
        <a href="/product/{{ $id }}" class="hidden lg:block w-2/3 h-full bg-transparent absolute top-0 left-0"></a>

        <!-- Product Image -->
        <div class="product-image h-28 w-28 bg-gray-800 rounded-md flex items-center justify-center overflow-hidden">
            <img src="{{ $imageUrl ?? '#' }}" alt="{{ $title }}" class="h-full w-full object-cover">
        </div>

        <!-- Product Details -->
        <div class="flex-grow">
            <h3 class="product-title text-lg font-semibold text-white mb-2">{{ $title }}</h3>
            <p class="product-description text-sm text-gray-300 leading-relaxed">
                {{ $description }}
            </p>
        </div>

        <!-- Price -->
        <div class="flex-shrink-0">
            <span class="product-price text-2xl font-bold text-white">
                £{{ number_format($price, 2) }}
            </span>
        </div>
    </div>

    <!-- Quantity Selector and Buttons -->
    <div class="flex items-center justify-end gap-4 mt-4 ">
        <form method="POST" action="{{ route('cart.store') }}">
            @csrf

            <!-- Quantity Selector -->
            <div class="flex items-center gap-2">
                <label for="quantity-{{ $id }}" class="text-sm text-gray-300">Qty:</label>
                <div class="flex items-center bg-zinc-800 text-white rounded-md overflow-hidden">
                    <button type="button" id="decrease-quantity-{{ $id }}"
                        class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white transition duration-200 bg-zinc-700 hover:bg-zinc-600">
                        -
                    </button>
                    <input type="number" id="quantity-{{ $id }}" name="quantity" min="1"
                        value="1"
                        class="w-12 h-8 text-center bg-transparent text-white outline-none border-none focus:ring-2 focus:ring-violet-700">
                    <button type="button" id="increase-quantity-{{ $id }}"
                        class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white transition duration-200 bg-zinc-700 hover:bg-zinc-600">
                        +
                    </button>
                </div>

                <!-- Add to Cart Button -->
                <input type="hidden" id="product_id" name="product_id" value="{{ $id }}">
                <button
                    class="add-to-cart-btn border border-violet-700 text-violet-700 px-5 py-2 rounded-md font-semibold hover:bg-violet-700 hover:text-white transition duration-300">
                    Add to Cart
                </button>
            </div>

        </form>

        <!-- Buy Now Button -->
        <button
            class="buy-now-btn px-5 py-2 rounded-md font-semibold bg-violet-700 text-white hover:bg-violet-800">
            Buy Now
        </button>
    </div>
</div>

<script nonce="{{ csp_nonce() }}">
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('quantity-{{ $id }}');

        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^1-9]/g, '');
        });

        input.addEventListener('keydown', function(event) {
            if (event.keyCode === 38 || event.keyCode === 40) {
                event.preventDefault();
            }
        });
    });

    // Quantity functionality
    document.getElementById('decrease-quantity-{{ $id }}').addEventListener('click', function() {
        var qtyInput = document.getElementById('quantity-{{ $id }}');
        var currentQty = parseInt(qtyInput.value);
        if (currentQty > 1) {
            qtyInput.value = currentQty - 1;
        }
    });

    document.getElementById('increase-quantity-{{ $id }}').addEventListener('click', function() {
        var qtyInput = document.getElementById('quantity-{{ $id }}');
        var currentQty = parseInt(qtyInput.value);
        qtyInput.value = currentQty + 1;
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

    /* Hover effects for both buttons */
    .add-to-cart-btn:hover {
        background-color: #7c3aed;
        color: #fff;
    }

    /* Preventing focus from being visually disturbing */
    .add-to-cart-btn:focus,
    .buy-now-btn:focus {
        outline: none;
    }
</style>
