{{--
Product view page to be used as a view on website.

Author(s): Kai Chima : Main Developer, Erick Vilcica: Backend developer

--}}

<x-layouts.layout>
    <x-slot:title>Keyosk | Product View</x-slot:title>
    <div class="bg-zinc-900/75 py-28 px-10  lg:px-14">
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
                        {{  $review_count != 1 ? $review_count . " Reviews" : "1 Review" }} </p>
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
            <div class="flex flew-row ring-violet-700 ring-2 rounded-md">
                <div class="size-7 flex items-center justify-center bg-zinc-700 rounded-bl-md rounded-tl-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </div>
                <input id="selectQuantity" class="w-10 h-7 px-[0.33rem] flex items-center justify-center bg-zinc-800 outline-none" value="1">
                <div class="size-7 flex items-center justify-center bg-zinc-700 rounded-br-md rounded-tr-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </div>
            </div>
            <div class="size-7 flex items-center justify-center ring-violet-700 ring-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
            </div>
        </div>
                </div>
                <div class="flex flex-wrap pt-3 gap-6 w-25">
                    <form class="lg:w-2/5" method="POST" action="{{ route('cart.store') }}">
                        @csrf
                        <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                        <!-- TODO: have a quantity selection input on the product view page -->
                        <input type="hidden" id="quantity" name="quantity" value="1">
                        <button type="submit" class="w-full px-7 py-2 rounded-sm bg-white hover:bg-zinc-200
                         text-md text-violet-700 text-xl shadow-md ">Add to cart</button>
                    </form>
                    <button class="lg:w-2/5 px-7 py-2 rounded-sm bg-violet-700 hover:bg-violet-500
                         text-md text-white text-xl shadow-md ">Buy now</button>
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
</script>