{{--
    product-card component.

    Author(s): Toms Xavi: Developer
--}}
@props(['p_product' => null, 'enable_buttons' => true])
<div class="product-card bg-stone-100 dark:bg-zinc-900 rounded-md p-6 flex flex-col gap-4 mb-6 relative hover:ring-4 hover:ring-orange-500 dark:hover:ring-violet-700/75 transition-all duration-300">
    <!-- Product Image and Info Container -->
    <div class="flex items-center gap-4">
        <!-- Clickable Element -->
        <a href="/product/{{ $productId }}" class="w-full h-2/3 bg-transparent absolute top-0 left-0"></a>

        <!-- Product Image -->
        <div class="size-40 bg-stone-200 dark:bg-zinc-900 rounded-md flex items-center justify-center overflow-hidden">
            <img src="{{ $productImage ?? '#' }}" alt="{{ $productTitle }}"
                class="h-full w-full object-contain">
        </div>


        <!-- Product Details -->
        <div class="flex-grow">
            <h3 class="product-title text-xl font-semibold text-zinc-800 dark:text-white mb-2">{{ $productTitle }}</h3>
            <p class="product-description text-base text-black/50 dark:text-gray-300 leading-relaxed">
                {{ $productShortDescription }}
            </p>
        </div>

        <!-- Price -->
        <div class="flex-shrink-0">
            <span class="product-price text-2xl font-bold text-zinc-800 dark:text-white">
                £{{ number_format($productPrice, 2) }}

                @if(Auth::user() && Auth::user()->is_admin)
                    <p class="justify-self-start text-base text-white/70">Stock: {{$productStock}}</p>
                @endif
            </span>
        </div>
    </div>

    <!-- Quantity Selector and Buttons -->
    @if($enable_buttons)
    <!-- Bottom dark section -->
    <div class="w-full h-[88px] bg-zinc-950/50 absolute z-0 bottom-0 left-0 rounded-b-md"></div>

    <!-- Cart buttons form -->
    <div class="flex items-center gap-4 mt-4 z-20">
       <x-util.form.cart-update :product="$p_product" class="w-full flex items-center justify-center gap-5"></x-util.form.cart-update>
    </div>
    @endif
</div>
