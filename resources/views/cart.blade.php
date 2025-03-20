<x-layouts.layout>
    <x-slot:title>Keyosk | Shop</x-slot:title>

    <main class="pt-[96px] w-full min-h-screen h-full flex justify-center">
        @php
            $cartService = app(\App\Services\CartService::class);
            $hasProducts = $cartService->hasProducts();
        @endphp

        @if(!$hasProducts)
        <span>Cart Empty.</span>
        @else
        <section class="w-full px-14 py-12" id="items">
            <div class="py-3 ml-1">
                <h1 class="font-bold text-2xl">
                    My Cart
                </h1>
                <p class="text-white/50">
                    <span class="cart-total-quantity-count">
                        @if(Auth::check())
                            {{ Auth::user()->cart->products()->count() }}
                        @else
                            {{ count($cartService->getProducts()) }}
                        @endif
                    </span> Item(s)
                </p>
            </div>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <div class="py-4 w-full h-fit flex flex-col gap-5">
                @if(Auth::check())
                    {{-- Authenticated user cart items --}}
                    @foreach(Auth::user()->cart->products()->orderBy("name")->get() as $product)
                        <x-navbar.cart-item :product="$product"/>
                    @endforeach
                @else
                    {{-- Guest user cart items --}}
                    @foreach($cartService->getProducts() as $product)
                        <x-navbar.guest-cart-item :product="$product"/>
                    @endforeach
                @endif
            </div>
        </section>

        <!-- Side bar -->
        <aside class="w-1/3 min-h-full px-14 py-12 bg-stone-100 dark:bg-zinc-900" id="totals">
            <h1 class="pb-3 ml-2 font-bold text-2xl">Summary</h1>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <div class="py-7 mx-2">
                <x-util.form.input placeholder="Promo Code"></x-util.form.input>
            </div>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <div class="hidden">
            @if(Auth::check())
                @foreach($cart->products()->orderBy("name")->get() as $product)
                    <p><span class="summary-product-quantity-{{ $product->id }}">{{ $product->pivot->quantity }}</span></p>
                @endforeach
            @else
                @foreach($cartService->getProducts() as $product)
                    <p><span class="summary-product-quantity-{{ $product['id'] }}">{{ $product['quantity'] }}</span></p>
                @endforeach
            @endif
            </div>
            <div class="py-7 mx-2 flex flex-col">
                <p class="mb-2 flex flex-row justify-between font-bold text-xl">
                    SUBTOTAL
                    <span class="flex flex-row">£
                       <span class="cart-subtotal-price">{{ number_format($cartService->getTotalPrice(), 2, '.', '') }}</span>
                    </span>
                </p>
                <p class="flex flex-row justify-between font-bold text-base text-black/50 dark:text-white/50">
                    SHIPPING
                    <span class="">TBD.</span>
                </p>
            </div>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <p class="py-7 mx-2 flex flex-row justify-between font-bold text-xl">
                ESTIMATED TOTAL
                <span class="flex flex-row">£
                    <span class="cart-subtotal-price">{{ number_format($cartService->getTotalPrice(), 2, '.', '') }}</span>
                </span>
            </p>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <div class="py-7 mx-2">
                @if(Auth::check() && Auth::user()->cart->products()->where(function($q) {
                    $q->where('stock', 0)->orWhereColumn('products.stock', '<', 'cart_product.quantity');
                })->exists())
                    <p class="pt-4 text-red-600">Some products in your cart are out of stock. Please remove them to continue to checkout.</p>
                @else
                    <x-util.button type="a" href="{{ route('checkout.get') }}" class="bg-transparent ring-2 ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 hover:bg-orange-500 dark:hover:bg-violet-800 hover:text-zinc-800 dark:hover:text-white ">Checkout</x-util.button>
                @endif
                <p class="pt-4 text-sm">Any Issues, contact us at 01543 682769</p>
            </div>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />
        </aside>
       @endif
    </main>
</x-layouts.layout>
