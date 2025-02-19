{{--
    product-card component.

    Author(s): Toms Xavi: Developer
--}}
@props(['enable_buttons' => true])
<div class="product-card bg-stone-100 dark:bg-zinc-900 rounded-md p-6 flex flex-col gap-4 mb-6 relative hover:ring-4 hover:ring-orange-500 dark:hover:ring-violet-700/75 transition-all duration-300">
    <!-- Product Image and Info Container -->
    <div class="flex items-center gap-4">
        <!-- Clickable Element -->
        <a href="/product/{{ $productId }}" class="w-full h-2/3 bg-transparent absolute top-0 left-0"></a>

        <!-- Product Image -->
        <div class="product-image h-32 w-32 bg-stone-200 dark:bg-zinc-900 rounded-md flex items-center justify-center overflow-hidden">
            <img src="{{ $productImage ?? '#' }}" alt="{{ $productTitle }}"
                class="h-full w-full object-contain">
        </div>


        <!-- Product Details -->
        <div class="flex-grow">
            <h3 class="product-title text-lg font-semibold text-zinc-800 dark:text-white mb-2">{{ $productTitle }}</h3>
            <p class="product-description text-sm text-black/50 dark:text-gray-300 leading-relaxed">
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
    <div class="flex items-center gap-4 mt-4 ">
        <form method="POST" action="{{ route('cart.update') }}" id="product-buy-form-{{ $productId }}" class="w-full flex items-center justify-center gap-5">
            <script nonce="{{ csp_nonce() }}">
                document.addEventListener('DOMContentLoaded', function() {
                    setupProductButtons('{{ $productId }}');
                });
            </script>
            @csrf
            <input type="hidden" id="cart_action" name="cart_action" value="{{ \App\Utils\CartUpdateAction::Add }}">
            <input type="hidden" id="product_id" name="product_id" value="{{ $productId }}">

            <x-util.button type="button" class="bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">Add to cart</x-util.button>
            <x-util.button type="button" class="py-[6px] bg-transparent ring-2 ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 hover:bg-orange-500 dark:hover:bg-violet-800 hover:text-zinc-800 dark:hover:text-white">Buy now</x-util.button>

            <div class="min-w-fit h-fit flex justify-center items-center bg-white dark:bg-zinc-800 text-white rounded-md overflow-hidden">
                <button type="button" id="decrease-quantity-{{ $productId }}"
                        class="w-8 h-8 flex items-center justify-center text-zinc-800 dark:text-gray-400  hover:text-zinc-700 dark:hover:text-white transition duration-200 bg-stone-200 dark:bg-zinc-700 hover:bg-stone-300 dark:hover:bg-zinc-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
                <input type="number" id="quantity-{{ $productId }}" name="quantity" min="1"
                       value="1"
                       class="w-12 h-8 text-center bg-transparent text-zinc-800 dark:text-white outline-none border-none"
                       style="-moz-appearance: textfield">
                <button type="button" id="increase-quantity-{{ $productId }}"
                        class="w-8 h-8 flex items-center justify-center text-zinc-800 dark:text-gray-400  hover:text-zinc-700 dark:hover:text-white transition duration-200 bg-stone-200 dark:bg-zinc-700 hover:bg-stone-300 dark:hover:bg-zinc-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
            </div>
        </form>
        <!-- Buy Now Button -->

    </div>
    @endif
</div>
