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
            <h1 class="pb-2 mb-5 font-bold border-b-2 border-violet-700">Cart | {{ $cart->products()->count() }} Items</h1>
            <div class="w-full min-h-screen h-fit flex flex-col gap-5">
                @foreach($cart->products as $product)
                    <x-navbar.cart-item class="border-2 border-violet-700" productImage="{{ $product->primaryImageLocation() ?? 'Undefined' }}" productTitle="{{ $product->name }}" productPrice="{{ $product->price }}" productQuantity="{{ Auth::user()->cart->getProductQuantity($product->id) }}"/>
                @endforeach
            </div>
            </section>
            <section class="w-96 h-fit p-7 mt-[54px] border-2 border-violet-700 bg-white dark:bg-zinc-900 rounded-md text-xl" id="totals">
                <h1 class="pb-2 font-bold border-b-2 border-violet-700">Order Summary</h1>
                <div class="flex flex-col py-5 border-b-2 border-violet-700 text-ellipsis">
                    @foreach($cart->products as $product)
                        <div class="flex items-center gap-1">
                            {{ $product->stock }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            {{ $product->name }}
                        </div>
                    @endforeach
                </div>
                <div class="py-5 border-b-2 border-violet-700">
                    <p>Items: {{ $cart->products->count() }}</p>
                    <p>Total: {{ $cart->getTotalPrice() }}</p>
                </div>
                <div class="pt-5">
                    <x-util.button class="bg-transparent ring-2 ring-violet-700 text-violet-700 hover:bg-violet-800 hover:text-white" type="button">Checkout Securely</x-util.button>
                </div>
            </section>
        @endif
    </main>
</x-layouts.layout>
