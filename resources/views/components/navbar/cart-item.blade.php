{{--
    Component for items that appear in the Shopping Basket on the website.

    Author(s): Ben Snaith: Main developer

    TODO:
--}}

<div {{ $attributes->merge(['class' => 'w-full px-5 flex flex-row gap-5 items-center text-center rounded-lg bg-stone-100 dark:bg-zinc-900 transition-colors duration-500']) }}>
    <div class="size-32 flex items-center overflow-hidden">
        <img src="{{ $productImage }}" alt="{{ $productImage }}" width="100" height="100" class="rounded-sm" />
    </div>
    <div class="w-full flex flex-col space-y-5">
        <div class="flex flex-col w-full items-center start-0">
            <h1 class="w-full flex font-bold">{{ $productTitle }}</h1>
            <p class="w-full flex text-black/30 dark:text-white/30">£{{ $productPrice }}</p>
        </div>
        <form class="cart-{{ $productId }} flex flex-row w-full justify-between items-center" method="POST"
            action="{{ route('cart.update') }}"> @csrf
            <input type="hidden" name="action" class="cart_action-{{ $productId }}">
            <input type="hidden" name="product_id" class="cart_id-{{ $productId }}" value="{{ $productId }}">
            <input type="hidden" name="quantity" class="cart_quantity-{{ $productId }}">
            <div class="flex flex-row ring-orange-500 dark:ring-violet-700 ring-2 rounded-md">
                <div class="cart_decrease-{{ $productId }} size-7 flex items-center justify-center bg-stone-200 dark:bg-zinc-700 hover:bg-black/10 dark:hover:bg-white/25 rounded-bl-md rounded-tl-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </div>
                <input name="quantity_input" class="cart_quantity_input-{{ $productId }} cart-quantity w-10 h-7 px-[0.33rem] flex items-center justify-center bg-white dark:bg-zinc-800 outline-none"
                    value="{{ $productQuantity }}">
                <div class="cart_increase-{{ $productId }} size-7 flex items-center justify-center bg-stone-200 dark:bg-zinc-700 hover:bg-black/10 dark:hover:bg-white/25 rounded-br-md rounded-tr-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </div>
            </div>
            <div class="cart_remove-{{ $productId }} size-7 flex items-center justify-center ring-orange-500 dark:ring-violet-700 hover:bg-black/5 dark:hover:bg-white/25 ring-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
            </div>
        </form>
    </div>
</div>

<script nonce="{{ csp_nonce() }}">
    document.addEventListener('DOMContentLoaded', function() {
        setupCartButtons('{{ $productId }}', '{{ $productQuantity }}')
    });
</script>
