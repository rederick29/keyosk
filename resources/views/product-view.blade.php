{{--
Product view page to be used as a view on website.

Author(s): Kai Chima : Main Developer, Erick Vilcica: Backend developer

--}}

<x-layouts.layout>
    <x-slot:title>Keyosk | Product View</x-slot:title>
    <div class="bg-white dark:bg-zinc-900/75 text-zinc-800 py-28 px-10 mx-10 lg:px-14">
        <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-10">
            <x-products.carousel>
                @foreach ($product->images as $image)
                    <x-products.image src="{{ $image->location }}" alt="Product image" />
                @endforeach
            </x-products.carousel>

            <div class="text-zinc-800 dark:text-white lg:pl-2 space-y-3">
                <h2 id="productName" class="pt-10 font-semibold text-4xl">{{ $product->name }}</h2>
                <p id="price" class="text-3xl">&pound;{{ number_format($product->price, 2, '.', ',') }}</p>
                @php $rating = $product->getAverageRating(); @endphp
                <!-- TODO: fix floating point string conversion to int -->
                <x-products.review-rating rating="{{ $rating }}">
                    <p id="rating" class="text-white text-xl">&ensp;{{ round($rating / 2, 1) }}&ensp;⋅</p>
                    @php $review_count = $product->reviews->count(); @endphp
                    <p id="stars" class="text-white text-xl pl-4 underline">
                        {{ $review_count != 1 ? $review_count . ' Reviews' : '1 Review' }} </p>
                </x-products.review-rating>

                @if ($product->stock > 15)
                    <p class="text-green-400 text-lg">In stock</p>
                @elseif ($product->stock < 1)
                    <p class="text-red-500 text-lg">Out of stock</p>
                @else
                    <p class="text-red-500 text-lg">Only {{ $product->stock }} left in stock</p>
                @endif

                <div class="">
                    <p>{{ $product->short_description }}</p>
                    <div class="flex flex-row w-full justify-between items-center">
                        <div class="flex items-center gap-2">

                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('cart.update') }}">
                    <div class="flex items-center gap-4 mt-4 pt-14">
                        @csrf
                        <input type="hidden" id="action" name="action"
                            value="{{ \App\Utils\CartUpdateAction::Add }}">
                        <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">

                        <!-- Quantity Selector -->
                        <div class="flex items-center gap-2">
                            <label for="quantity-{{ $product->id }}"
                                class="text-sm text-zinc-800 dark:text-gray-300">Qty:</label>
                            <div
                                class="flex items-center bg-white dark:bg-zinc-800 text-white rounded-md overflow-hidden">
                                <button type="button" id="decrease-quantity-{{ $product->id }}"
                                    class="w-8 h-8 flex items-center justify-center text-zinc-800 dark:text-gray-400  hover:text-zinc-700 dark:hover:text-white transition duration-200 bg-stone-200 dark:bg-zinc-700 hover:bg-stone-300 dark:hover:bg-zinc-600">
                                    -
                                </button>
                                <input type="number" id="quantity-{{ $product->id }}" name="quantity" min="1"
                                    value="1"
                                    class="w-12 h-8 text-center bg-transparent text-zinc-800 dark:text-white outline-none border-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                <button type="button" id="increase-quantity-{{ $product->id }}"
                                    class="w-8 h-8 flex items-center justify-center text-zinc-800 dark:text-gray-400  hover:text-zinc-700 dark:hover:text-white transition duration-200 bg-stone-200 dark:bg-zinc-700 hover:bg-stone-300 dark:hover:bg-zinc-600">
                                    +
                                </button>
                            </div>

                            <!-- Add to Cart Button -->
                            <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                        </div>
                        <div class="space-x-4">
                            <button
                                class="add-to-cart-btn border border-orange-500 dark:border-violet-700 text-orange-500 dark:text-violet-700 px-5 py-2 rounded-md font-semibold hover:bg-orange-500 dark:hover:bg-violet-700 hover:text-zinc-800 dark:hover:text-white transition duration-300">
                                Add to Cart
                            </button>

                            <!-- Buy Now Button -->
                            <button
                                class="buy-now-btn px-5 py-2 rounded-md font-semibold bg-orange-500 dark:bg-violet-700 text-zinc-800 dark:text-white hover:bg-orange-600 dark:hover:bg-violet-800">
                                Buy Now
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="text-zinc-800 dark:text-white lg:pl-10 pt-10">
        <h3 class="text-orange-500 dark:text-violet-500 text-xl font-semibold pb-3">Details</h3>
        <p>{{ $product->description }}</p>
    </div>
    <div class="text-zinc-800 dark:text-white lg:px-10 pt-7 pb-6">
        <h3 class="text-orange-500 text-xl font-semibold pb-2">Reviews</h3>
        @foreach ($product->reviews as $review)
            <div class="border-t border-orange-500 dark:border-violet-700">
                <p class="py-2 pt-4">{{ $review->user->name }}</p>
                <x-products.review-rating class="w-3 h-3" rating="{{ $review->rating }}">
                    <p id="rating" class="text-white font-semibold">&emsp;{{ $review->subject }}</p>
                </x-products.review-rating>
                <p class="py-2 pb-4">{{ $review->comment }}</p>
            </div>
        @endforeach
        <a href="" class="text-orange-500 dark:text-violet-700 underline">More Reviews -></a>
    </div>
    </div>
</x-layouts.layout>

<script nonce="{{ csp_nonce() }}">
    // OndoMREADY
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('quantity-{{ $product->id }}');

        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^1-9]/g, '');
            if (this.value === '' || parseInt(this.value) < 1 || parseInt(this.value) > 99) {
                this.value = 0;
            }
        });

        input.addEventListener('keydown', function(event) {
            if (event.keyCode === 38 || event.keyCode === 40) {
                event.preventDefault();
            }
        });

        // + and -
        document.getElementById('decrease-quantity-{{ $product->id }}').addEventListener('click', function() {
            var qtyInput = document.getElementById('quantity-{{ $product->id }}');
            var currentQty = parseInt(qtyInput.value);
            if (currentQty > 1) {
                qtyInput.value = currentQty - 1;
            }
        });

        document.getElementById('increase-quantity-{{ $product->id }}').addEventListener('click', function() {
            var qtyInput = document.getElementById('quantity-{{ $product->id }}');
            var currentQty = parseInt(qtyInput.value);
            qtyInput.value = currentQty + 1;
        });
    });
</script>
