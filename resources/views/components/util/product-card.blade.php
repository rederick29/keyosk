{{--
    product cards element.

    Author(s): Toms Xavi : Developer
--}}

<div
    class="product-card bg-gradient-to-br from-gray-900 to-black border border-transparent rounded-2xl p-6 flex flex-col gap-4 shadow-lg mb-6 neon-box">
    <!-- Product Image and Info Container -->
    <div class="flex items-center gap-4 mb-4">
        <!-- Product Image -->
        <div class="product-image h-28 w-28 bg-gray-800 rounded-lg flex items-center justify-center overflow-hidden">
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

    <!-- Buy Button -->
    <div class="flex justify-center">
        <button
            class="buy-button bg-gradient-to-r from-purple-700 to-purple-800 text-white px-8 py-3 rounded-full font-semibold shadow-lg w-full transition duration-300 hover:bg-gradient-to-r hover:from-purple-800 hover:to-purple-900 hover:shadow-xl">
            <!-- Quantity Selector and Buttons -->
            <div class="flex items-center justify-end gap-4 mt-4">
                <!-- Quantity Selector -->
                <div class="flex items-center gap-2">
                    <label for="quantity-{{ $id }}" class="text-sm text-gray-300">Qty:</label>
                    <div class="flex items-center bg-zinc-800 text-white rounded-md overflow-hidden">
                        <button type="button" id="decrease-quantity"
                            class="w-8 h-full flex items-center justify-center text-gray-400 hover:text-white transition duration-200 bg-zinc-700 hover:bg-zinc-600">
                            -
                        </button>
                        <input type="number" id="quantity-{{ $id }}" name="quantity" min="0"
                            value="0"
                            class="w-12 h-full text-center bg-transparent text-white outline-none border-none focus:ring-2 focus:ring-violet-700">
                        <button type="button" id="increase-quantity"
                            class="w-8 h-full flex items-center justify-center text-gray-400 hover:text-white transition duration-200 bg-zinc-700 hover:bg-zinc-600">
                            +
                        </button>
                    </div>
                </div>

                <!-- Add to Cart Button -->
                <button
                    class="add-to-cart-btn border border-violet-700 text-violet-700 px-5 py-2 rounded-md font-semibold hover:bg-violet-700 hover:text-white transition duration-300">
                    Add to Cart
                </button>

                <!-- Buy Now Button -->
                <button
                    class="buy-now-btn border border-violet-700 text-violet-700 px-5 py-2 rounded-md font-semibold hover:bg-violet-700 hover:text-white transition duration-300">
                    Buy Now
                </button>
            </div>
    </div>

    <style>
        /* Create the neon glow animation that moves around the box */
        @keyframes neon-glow {
            0% {
                border-color: transparent;
                box-shadow: 0 0 5px rgba(128, 0, 128, 0.7), 0 0 10px rgba(128, 0, 128, 0.5);
            }

            25% {
                border-color: transparent;
                box-shadow: 5px 0 5px rgba(128, 0, 128, 0.7), -5px 0 5px rgba(128, 0, 128, 0.5);
            }

            50% {
                border-color: transparent;
                box-shadow: 0 5px 5px rgba(128, 0, 128, 0.7), 0 -5px 5px rgba(128, 0, 128, 0.5);
            }

            75% {
                border-color: transparent;
                box-shadow: -5px 0 5px rgba(128, 0, 128, 0.7), 5px 0 5px rgba(128, 0, 128, 0.5);
            }

            100% {
                border-color: transparent;
                box-shadow: 0 0 5px rgba(128, 0, 128, 0.7), 0 0 10px rgba(128, 0, 128, 0.5);
            }
        }

        /* Apply the neon effect to the product card */
        .product-card {
            position: relative;
            border: 2px solid transparent;
            transition: border-color 0.3s ease-in-out;
        }

        .product-card:hover {
            animation: neon-glow 4s infinite;
            /* Animates the glow around the card */
            border-color: rgba(128, 0, 128, 0.6);
            /* Visible border on hover */
        }

        /* Ensure button doesn't get affected by animation */
        .buy-button {
            z-index: 10;
        }

        /* Styling for Quantity Selector */
        .quantity-selector input {
            appearance: none;
            /* Removes browser default styles */
            padding: 0.25rem 0;
            font-size: 1rem;
            text-align: center;
            height: 2.5rem;
        }

        .quantity-selector button {
            font-size: 1.25rem;
            line-height: 1;
            font-weight: bold;
            height: 2.5rem;
        }

        .quantity-selector button:focus-visible {
            outline: 2px solid #7c3aed;
            /* Focus outline */
            outline-offset: 2px;
        }

        /* Styling for Buttons */
        .add-to-cart-btn,
        .buy-now-btn {
            font-size: 1rem;
            font-weight: bold;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

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

    <script>
        // Quantity functionality
        document.getElementById('decrease-quantity').addEventListener('click', function() {
            var qtyInput = document.getElementById('quantity-{{ $id }}');
            var currentQty = parseInt(qtyInput.value);
            if (currentQty > 0) {
                qtyInput.value = currentQty - 1;
            }
        });

        document.getElementById('increase-quantity').addEventListener('click', function() {
            var qtyInput = document.getElementById('quantity-{{ $id }}');
            var currentQty = parseInt(qtyInput.value);
            qtyInput.value = currentQty + 1;
        });
    </script>
</div>
