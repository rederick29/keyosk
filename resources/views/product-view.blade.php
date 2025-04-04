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
                        <div class="flex items-center gap-2"></div>
                    </div>
                </div>

                @vite('resources/ts/product-buttons.ts')
                <form method="POST" action="{{ route('cart.update') }}" id="product-buy-form-{{ $product->id }}">
                    <div class="flex items-center gap-4 mt-4 pt-14">
                        @csrf
                        <input type="hidden" id="cart_action" name="cart_action"
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
                                    class="w-12 h-8 text-center bg-transparent text-zinc-800 dark:text-white outline-hidden border-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                <button type="button" id="increase-quantity-{{ $product->id }}"
                                    class="w-8 h-8 flex items-center justify-center text-zinc-800 dark:text-gray-400  hover:text-zinc-700 dark:hover:text-white transition duration-200 bg-stone-200 dark:bg-zinc-700 hover:bg-stone-300 dark:hover:bg-zinc-600">
                                    +
                                </button>
                            </div>
                        </div>
                        <div class="space-x-4">
                            <!-- Add to Cart Button -->
                            <button type="submit"
                                class="add-to-cart-btn-{{ $product->id }} border border-orange-500 dark:border-violet-700 text-orange-500 dark:text-violet-700 px-5 py-2 rounded-md font-semibold hover:bg-orange-500 dark:hover:bg-violet-700 hover:text-zinc-800 dark:hover:text-white transition duration-300">
                                Add to Cart
                            </button>

                            <!-- Buy Now Button -->
                            <button type="submit" href="/checkout"
                                class="buy-now-btn-{{ $product->id }} px-5 py-2 rounded-md font-semibold bg-orange-500 dark:bg-violet-700 text-zinc-800 dark:text-white hover:bg-orange-600 dark:hover:bg-violet-800">
                                Buy Now
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-zinc-900/75 text-zinc-800 px-10 mx-10 lg:px-14">
        <div class="text-zinc-800 dark:text-white lg:pl-10">
            <h3 class="text-orange-500 dark:text-violet-500 text-xl font-semibold pb-3">Details</h3>
            <p>{{ $product->description }}</p>
        </div>
        <div class="text-zinc-800 dark:text-white lg:px-10 pt-7 pb-6">
            <h3 class="reviews-holder text-orange-500 dark:text-violet-500 text-xl font-semibold pb-2">Reviews</h3>
            @auth
            <!-- TODO: this is a working placeholder for an actual "leave review" -->
            @if(\App\Models\Product::findOrderedBy($product->id, Auth::user()) && !\App\Models\Review::findReview($product->id, Auth::id()))
                <h2 class="text-orange-500 dark:text-violet-500 text-lg font-semibold pb-2">Leave a review:</h2>
                <form class="leave-review flex flex-col outline-2 outline-orange-500 dark:outline-violet-500 rounded w-fit [&>*]:p-2 [&>input]:outline-2" method="POST" action=""> @csrf
                    <label for="new-review-rating">Rating (0-10): </label>
                    <input type="number" id="new-review-rating" name="rating" min="0" max="10" step="1" value="" required>
                    <label for="new-review-rating">Subject: </label>
                    <input type="text" id="new-review-subject" name="subject" max="100">
                    <label for="new-review-rating">Details: </label>
                    <input type="text" id="new-review-comment" name="comment" max="1000">
                    <label for="new-review-anonymous">Don't display name: </label>
                    <input type="checkbox" id="new-review-anonymous" name="anonymous">
                    <input type="submit">
                </form>
            @endif
            @endauth
            @foreach ($product->reviews as $review)
                <x-products.review :review="$review"/>
            @endforeach
        </div>
    </div>
</x-layouts.layout>

<script nonce="{{ csp_nonce() }}">
    document.addEventListener('DOMContentLoaded', function() {
        setupProductButtons('{{ $product->id }}');
    });
</script>
