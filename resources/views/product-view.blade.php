{{--
Product view page to be used as a view on website.

Author(s): Kai Chima : Main Developer, Erick Vilcica: Backend developer

--}}

<x-layouts.layout>
    <x-slot:title>Keyosk | Product View</x-slot:title>
    <main class="py-[136px] flex flex-col items-center justify-center">

        <!-- Product top card -->
        <section class="w-5/6 h-fit p-10 flex justify-between gap-10 bg-zinc-900 rounded-md">
            <!-- Carousel -->
            <div class="h-96 w-[600px] bg-orange-500 rounded-md"></div>

            <div class="w-2/3 flex flex-col">
                <h2 class="mx-2 text-3xl font-bold">{{ $product->name }}</h2>

                <div class="py-5 mx-2 flex justify-between">
                    <!-- Product price -->
                    <p class="text-2xl font-normal">&pound;{{ number_format($product->price, 2, '.', ',') }}</p>

                    <!-- Product rating -->
                    @php $rating = $product->getAverageRating(); @endphp
                    <!-- TODO: fix floating point string conversion to int -->
                    <x-products.review-rating rating="{{ $rating }}">
                        <p id="rating">&ensp;{{ round($rating / 2, 1) }}</p>
                        @php $review_count = $product->reviews->count(); @endphp
                        <p id="stars">{{ '('.$review_count.')' }} </p>
                    </x-products.review-rating>
                </div>

                <div class="pb-5 mx-2">
                    @if ($product->stock > 15)
                        <p class="text-green-400">IN STOCK</p>
                    @elseif ($product->stock < 1)
                        <p class="text-red-500">Out of stock</p>
                    @else
                        <p class="text-yellow-500">Only {{ $product->stock }} left in stock</p>
                    @endif
                </div>

                <hr class="w-full border-2 rounded-xl border-stone-200 dark:border-zinc-700" />

                <div class="mx-2 py-4 grow">


                    <div class="">
                        <p>{{ $product->short_description }}</p>
                        <div class="flex flex-row w-full justify-between items-center">
                            <div class="flex items-center gap-2"></div>
                        </div>
                    </div>
                </div>

                <!-- Cart buttons form -->
                <div class="mx-2">
                    @vite('resources/ts/product-buttons.ts')
                    <x-util.form.cart-update :product="$product" class="flex flex-col-reverse gap-3 [&>div]:self-end"></x-util.form.cart-update>
                </div>
            </div>
        </section>




    </main>
{{--    <div class="bg-white dark:bg-zinc-900/75 text-zinc-800 px-10 mx-10 lg:px-14">--}}
{{--        <div class="text-zinc-800 dark:text-white lg:pl-10">--}}
{{--            <h3 class="text-orange-500 dark:text-violet-500 text-xl font-semibold pb-3">Details</h3>--}}
{{--            <p>{{ $product->description }}</p>--}}
{{--        </div>--}}
{{--        <div class="text-zinc-800 dark:text-white lg:px-10 pt-7 pb-6">--}}
{{--            <h3 class="text-orange-500 dark:text-violet-500 text-xl font-semibold pb-2">Reviews</h3>--}}
{{--            @foreach ($product->reviews as $review)--}}
{{--                <div class="border-t border-orange-500 dark:border-violet-700">--}}
{{--                    <p class="py-2 pt-4">{{ $review->user->name }}</p>--}}
{{--                    <x-products.review-rating class="w-3 h-3" rating="{{ $review->rating }}">--}}
{{--                        <p id="rating" class="text-white font-semibold">&emsp;{{ $review->subject }}</p>--}}
{{--                    </x-products.review-rating>--}}
{{--                    <p class="py-2 pb-4">{{ $review->comment }}</p>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--            <a href="" class="text-orange-500 dark:text-violet-700 underline">More Reviews -></a>--}}
{{--        </div>--}}
{{--    </div>--}}
</x-layouts.layout>
