{{--
Product view page to be used as a view on website.

Author(s): Kai Chima : Main Developer, Erick Vilcica: Backend developer

--}}

<x-layouts.layout>
    <x-slot:title>Keyosk | Product View</x-slot:title>
    <div class="bg-zinc-900/75 py-28 px-10 max-w-4xl lg:max-w-7xl lg:mx-14">
        <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-10">
            <x-products.carousel>
                @foreach($product->images as $image)
                    <x-products.image src="{{ $image->location }}" alt="Product image"/>
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
                    <p id="stars" class="text-white text-xl pl-4 underline"> {{  $review_count != 1 ? $review_count . " Reviews" : "1 Review" }} </p>
                </x-products.review-rating>
                <div class="">
                    <p>{{ $product->short_description }}</p>
                </div>
                <div class="flex flex-wrap pt-3 gap-6 w-25">
                    <form class="w-2/5" method="POST" action="{{ route('cart.update') }}">
                        @csrf
                        <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                        <!-- TODO: have a quantity selection input on the product view page -->
{{--                        <input type="hidden" id="quantity" name="quantity" value="1">--}}
                        <input type="hidden" id="action" name="action" value="{{ \App\Utils\CartUpdateAction::Add }}">
                        <button type="submit" class="w-full px-7 py-2 rounded-3xl bg-white hover:bg-zinc-200
                         text-md text-violet-700 text-xl shadow-md ">Add to cart</button>
                    </form>
                    <button
                        class="w-2/5 px-7 py-2 rounded-3xl bg-violet-700 hover:bg-violet-500
                         text-md text-white text-xl shadow-md ">Buy now</button>
                </div>
            </div>
        </div>
        <div class="text-white lg:pl-10 pt-10">
            <h3 class="text-violet-500 text-xl font-semibold pb-3">More Details</h3>
            <p>{{ $product->description }}</p>
        </div>
        <div class="text-white lg:pl-10 pt-7">
            <h3 class="text-violet-500 text-xl font-semibold">Reviews</h3>
            @foreach($product->reviews as $review)
                <p class="py-4">{{ $review->user->name }}</p>
                <p class="py-4">{{ $review->subject }}</p>
                <p class="py-4">{{ $review->comment }}</p>
            @endforeach
            <a href="" class="text-violet-700 underline">More Reviews -></a>
        </div>
    </div>
</x-layouts.layout>


