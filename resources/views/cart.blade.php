<x-layouts.layout>
    <x-slot:title>Keyosk | Shop</x-slot:title>

    <main class="px-10 pt-32 pb-[32px] w-full h-fit flex justify-center gap-10">
        @if(!Auth::user()->cart)
            <span>Cart Empty.</span>
        @else
            <section class="w-full" id="items">
            @php
                $user = Auth::user();
                $cart = $user->cart ?? App\Models\Cart::factory()->forUser($user)->create();
            @endphp
            <h1 class="flex flex-row gap-1 pb-2 mb-5 font-bold border-b-2 border-orange-500 dark:border-violet-700">
                Cart |
                <span class="cart-total-quantity-count">{{ $cart->products()->count() }}</span>
                Items
            </h1>
            <div class="w-full min-h-screen h-fit flex flex-col gap-5">
                @foreach($cart->products()->orderBy("name")->get() as $product)
                    <x-navbar.cart-item class="border-2 border-orange-500 dark:border-violet-700" :product="$product"/>
                @endforeach
            </div>
            </section>
            <section class="w-96 h-fit p-7 mt-[54px] border-2 border-orange-500 dark:border-violet-700 bg-stone-100 dark:bg-zinc-900 rounded-md text-xl" id="totals">
                <h1 class="pb-2 font-bold border-b-2 border-orange-500 dark:border-violet-700">Order Summary</h1>
                <div class="flex flex-col py-5 border-b-2 border-orange-500 dark:border-violet-700 text-ellipsis">
                    @foreach($cart->products()->orderBy("name")->get() as $product)
                        <div class="summary-product-{{ $product->id }} flex items-center gap-1">
                            <span class="summary-product-quantity">{{ $product->pivot->quantity }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            {{ $product->name }}
                        </div>
                    @endforeach
                </div>
                <div class="py-5 border-b-2 border-orange-500 dark:border-violet-700">
                    <p class="flex flex-row gap-1">
                        Items:
                        <span class="cart-total-quantity-count">{{ $cart->products->count() }}</span>
                    </p>
                    <p class="flex flex-row">
                        Total: £
                        <span class="cart-subtotal-price">{{ $cart->getTotalPrice() }}</span>
                    </p>
                </div>
                <div class="pt-5">
                    <x-util.button class="bg-transparent ring-2 ring-orange-500 dark:ring-violet-700  text-orange-500 dark:text-violet-700 hover:bg-orange-500 dark:hover:bg-violet-800 hover:text-zinc-800 dark:hover:text-white" type="button">Checkout Securely</x-util.button>
                </div>
            </section>
        @endif
    </main>
</x-layouts.layout>
