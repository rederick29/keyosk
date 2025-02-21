@props(['product' => null])
<form method="POST" action="{{ route('cart.update') }}" id="product-buy-form-{{ $product->id }}" {{ $attributes->merge(['class' => '']) }}>
    <script nonce="{{ csp_nonce() }}">
        document.addEventListener('DOMContentLoaded', function() {
            setupProductButtons('{{ $product->id }}');
        });
    </script>
    @csrf
    <input type="hidden" id="cart_action" name="cart_action" value="{{ \App\Utils\CartUpdateAction::Add }}">
    <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">

    <x-util.button type="button" class="bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">Add to cart</x-util.button>
    <x-util.button type="button" class="py-[6px] bg-transparent ring-2 ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 hover:bg-orange-500 dark:hover:bg-violet-800 hover:text-zinc-800 dark:hover:text-white">Buy now</x-util.button>

    <div class="min-w-fit max-w-fit h-fit flex justify-center items-center bg-white dark:bg-zinc-800 text-white rounded-md overflow-hidden">
        <button type="button" id="decrease-quantity-{{ $product->id }}"
                class="w-8 h-8 flex items-center justify-center text-zinc-800 dark:text-gray-400  hover:text-zinc-700 dark:hover:text-white transition duration-200 bg-stone-200 dark:bg-zinc-700 hover:bg-stone-300 dark:hover:bg-zinc-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </button>
        <input type="number" id="quantity-{{ $product->id }}" name="quantity" min="1"
               value="1"
               class="w-12 h-8 text-center bg-transparent text-zinc-800 dark:text-white outline-none border-none"
               style="-moz-appearance: textfield">
        <button type="button" id="increase-quantity-{{ $product->id }}"
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
