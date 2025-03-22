{{--
    Image carousel element.

    Author(s): Toms Xavi : Developer
--}}

@vite(['resources/ts/carousel.ts'])
<div class="md:p-4 md:mx-96 my-20">
    <div class="w-full flex justify-center relative">
        <!-- Left Scroll Button -->
        <button id="scroll-left" class="hidden md:block absolute left-4 top-1/2 transform -translate-y-1/2 bg-white dark:bg-zinc-900 bg-opacity-70  text-zinc-800 dark:text-white p-4 rounded-full shadow-lg hover:bg-opacity-90 transition duration-300 z-20">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <!-- Product Carousel -->
        <div id="scroll-container" class="bg-transparent py-1 w-10/12 mx-4 flex overflow-x-hidden scrollbar-hide object-contain">
            <!-- Debugging: Check if $products is empty -->
            @if(\App\Models\Product::all()->count() > 0)
                @foreach(\App\Models\Product::latest()->take(10)->get() as $product)
                    <div class="product-card">
                        <x-carousel.item-card
                            :id="$product->id"
                            :image="$product->primaryImageLocation()"
                            :alt="$product->name"
                            :title="$product->name"
                            :description="$product->description"
                            :price="$product->price"
                        />
                    </div>
                @endforeach
            @else
                <p class="text-red-500 text-center w-full">❌ No products found in the database.</p>
            @endif

        </div>

        <!-- Right Scroll Button -->
        <button id="scroll-right" class="hidden md:block absolute right-4 top-1/2 transform -translate-y-1/2 bg-white dark:bg-zinc-900 bg-opacity-70 text-zinc-800 dark:text-white p-4 rounded-full shadow-lg hover:bg-opacity-90 transition duration-300 z-20">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>
