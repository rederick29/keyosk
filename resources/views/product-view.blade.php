{{--
Product view page to be used as a view on website.

Author(s): Kai Chima : Main Developer, Erick Vilcica: Backend developer

--}}

<x-layouts.layout>
    <x-slot:title>Keyosk | Product View</x-slot:title>
    <div class="bg-zinc-900/75 py-28 px-10 mx-10 lg:px-14">
        <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-10">
            <x-products.carousel>
                @foreach($product->images as $image)
                    <x-products.image src="{{ $image->location }}" alt="Product image" />
                @endforeach
            </x-products.carousel>

            <div class="text-white lg:pl-2 space-y-3">
                <h2 id="productName" class="pt-10 font-semibold text-4xl">{{ $product->name }}</h2>
                <p id="price" class="text-3xl">&pound;{{ number_format($product->price, 2, '.', ',') }}</p>
                @php $rating = $product->getAverageRating(); @endphp
                <!-- TODO: fix floating point string conversion to int -->
                <x-products.review-rating rating="{{ $rating }}">
                    <p id="rating" class="text-white text-xl">&ensp;{{ round($rating / 2, 1) }}&ensp;⋅</p>
                    @php $review_count = $product->reviews->count(); @endphp
                    <p id="stars" class="text-white text-xl pl-4 underline">
                        {{  $review_count != 1 ? $review_count . " Reviews" : "1 Review" }}
                    </p>
                </x-products.review-rating>
                @if ($product->stock > 15)
                    <p class="text-green-400 text-lg">In stock</p>
                @elseif ($product->stock < 1)
                    <p class="text-red-500 text-lg">Out of stock</p>
                @else
                    <p class="text-red-500 text-lg">Only {{$product->stock}} left in stock</p>
                @endif
                <div class="">
                    <p>{{ $product->short_description }}</p>
                    <div class="flex flex-row w-full justify-between items-center">
                        <div class="flex items-center gap-2">

                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap gap-6 w-25">
                    <form class=" grid grid-rows-2" method="POST" action="{{ route('cart.store') }}">
                        @csrf
                        <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                        <!-- TODO: have a quantity selection input on the product view page -->
                        <div class="w-28">
                            <label for="quantity-{{ $product->id }}" class="text-md text-gray-300">Qty:</label>
                            <div class="flex items-center bg-zinc-800 text-white rounded-md overflow-hidden">
                                <button type="button" id="decrease-quantity-{{ $product->id }}"
                                    class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white transition duration-200 bg-zinc-700 hover:bg-zinc-600">
                                    -
                                </button>
                                <input type="number" id="quantity-{{ $product->id }}-input" name="quantity" min="0"
                                    value="1"
                                    class="w-12 h-8 text-center bg-transparent text-white outline-none border-none focus:ring-2 focus:ring-violet-700">
                                <button type="button" id="increase-quantity-{{ $product->id }}"
                                    class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white transition duration-200 bg-zinc-700 hover:bg-zinc-600">
                                    +
                                </button>
                            </div>
                        </div><div class="space-x-5 pt-5">
                        <button type="submit" class=" px-7 py-2 rounded-sm bg-white hover:bg-zinc-200
                         text-md text-violet-700 text-xl shadow-md ">Add to cart</button>
                    </form>
                    <button class=" px-7 py-2 rounded-sm bg-violet-700 hover:bg-violet-500
                         text-md text-white text-xl shadow-md ">Buy now</button></div>
                </div>
            </div>
        </div>
        <div class="text-white lg:pl-10 pt-10">
            <h3 class="text-violet-500 text-xl font-semibold pb-3">Details</h3>
            <p>{{ $product->description }}</p>
        </div>
        <div class="text-white lg:px-10 pt-7">
            <h3 class="text-violet-500 text-xl font-semibold pb-2">Reviews</h3>
            @foreach($product->reviews as $review)
                <div class="border-t border-violet-700">
                    <p class="py-2 pt-4">{{ $review->user->name }}</p>
                    @php    $revRating = $review->rating; @endphp
                    <x-products.review-rating class="w-3 h-3" rating="{{ $revRating }}">
                        <p id="rating" class="text-white font-semibold">&emsp;{{ $review->subject }}</p>
                    </x-products.review-rating>
                    <p class="py-2 pb-4">{{ $review->comment }}</p>
                </div>
            @endforeach
            <a href="" class="text-violet-700 underline">More Reviews -></a>
        </div>
    </div>
</x-layouts.layout>

<script>
    function getQuantity() {
        let quantity = document.getElementById('selectQuantity').getAttribute('value');
        document.getElementById('quanity').value = quantity;
    }
    document.getElementById('decrease-quantity-{{ $product->id }}').addEventListener('click', function () {
        var qtyInput = document.getElementById('quantity-{{ $product->id }}');
        var currentQty = parseInt(qtyInput.value);
        if (currentQty > 0) {
            qtyInput.value = currentQty - 1;
        }
    });

    document.getElementById('increase-quantity-{{ $product->id }}').addEventListener('click', function () {
        var qtyInput = document.getElementById('quantity-{{ $product->id }}');
        var currentQty = parseInt(qtyInput.value);
        qtyInput.value = currentQty + 1;
    });
</script>