<x-layouts.layout>
    <x-slot:title>Keyosk | Shop</x-slot:title>

    <main class="pt-[96px] w-full min-h-screen h-full flex justify-center">
        @if(!Auth::user()->cart)
        <span>Cart Empty.</span>
        @else
        <section class="w-full px-14 py-12" id="items">
        @php
            $user = Auth::user();
            $cart = $user->cart ?? App\Models\Cart::factory()->forUser($user)->create();
        @endphp
        <div class="py-3 ml-1">
        <h1 class="font-bold text-2xl">
            My Cart
        </h1>
        <p class="text-white/50">
            <span class="cart-total-quantity-count">{{ $cart->products()->count() }}</span> Item(s)
        </p>
        </div>

        <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

        <div class="py-4 w-full h-fit flex flex-col gap-5">
            @foreach($cart->products()->orderBy("name")->get() as $product)
                <x-navbar.cart-item :product="$product"/>
            @endforeach
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

            <div class="py-7 mx-2 flex flex-col">
                <p class="mb-2 flex flex-row justify-between font-bold text-xl">
                    SUBTOTAL
                    <span class="cart-subtotal-price">£{{ $cart->getTotalPrice() }}</span>
                </p>
                <p class="flex flex-row justify-between font-bold text-base text-black/50 dark:text-white/50">
                    SHIPPING
                    <span class="cart-subtotal-price">TBD.</span>
                </p>
            </div>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <p class="py-7 mx-2 flex flex-row justify-between font-bold text-xl">
                ESTIMATED TOTAL
                <span class="cart-subtotal-price">£{{ $cart->getTotalPrice() }}</span>
            </p>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <div class="py-7 mx-2">
                @if($cart->products()->where(function($q) {
                    $q->where('stock', 0)->orWhereColumn('products.stock', '<', 'cart_product.quantity');
                })->exists())
                    <p class="pt-4 text-red-600">Some products in your cart are out of stock. Please remove them to continue to checkout.</p>
                @else
                    @vite('resources/ts/checkout.ts')
                    <x-util.button type="a" href="/checkout" data-checkout-button class="bg-transparent ring-2 ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 hover:bg-orange-500 dark:hover:bg-violet-800 hover:text-zinc-800 dark:hover:text-white " type="button">Checkout</x-util.button>
                @endif
                <p class="pt-4 text-sm">Any Issues, contact us at 01543 682769</p>
            </div>

            <hr class="w-full mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />
        </aside>
       @endif
    </main>
</x-layouts.layout>
