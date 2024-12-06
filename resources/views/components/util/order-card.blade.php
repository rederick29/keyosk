{{--
product-card component.

Author(s): Toms Xavi: Developer
--}}


<div class="product-card bg-zinc-900 border-2 border-violet-700 rounded-md p-6 flex flex-col gap-4 shadow-lg mb-6">
    <!-- Product Image and Info Container -->
    <div class="flex items-center gap-4">
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
    <div class="flex items-center justify-end gap-4 mt-4">



        <!-- View Products Button -->
        <button
            class="buy-now-btn border border-violet-700 text-violet-700 px-5 py-2 rounded-md font-semibold hover:bg-violet-700 hover:text-white transition duration-300">
            Veiw Products
        </button>
    </div>
</div>

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
    .add-to-cart-btn:hover,
    .buy-now-btn:hover {
        background-color: #7c3aed;
        color: #fff;
    }

    /* Preventing focus from being visually disturbing */
    .add-to-cart-btn:focus,
    .buy-now-btn:focus {
        outline: none;
    }
</style>