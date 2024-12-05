<x-layouts.layout>
    <x-slot:title>Keyosk | Shop</x-slot:title>

    <main class="px-10 pt-32 pb-[32px] w-full h-fit flex justify-center gap-10">
            @if(Auth::check())
                @if(!Auth::user()->cart)
                    <span>Cart Empty.</span>
                @else
                <section class="w-full" id="items">
                <h1 class="pb-2 mb-5 font-bold border-b-2 border-violet-700">Cart | [] Items</h1>
                <div class="w-full h-fit flex flex-col gap-5">
                    @foreach(Auth::user()->cart->products as $product)
                        <x-util.product-card title="{{ $product->name }}" description="{{ $product->description }}" price="{{ $product->price }}" quantity="{{ $product->stock }}"/>
                    @endforeach
                </div>
                </section>
                <section class="w-96 h-fit p-7 mt-[54px] border-2 border-violet-700 bg-zinc-900 rounded-md" id="totals">
                    <h1 class="pb-2 font-bold border-b-2 border-violet-700">Order Summary</h1>
                    <div>
                        @foreach(Auth::user()->cart->products as $product)
                            <div>{{ $product->stock }} x {{ $product->name }}</div>
                        @endforeach
                    </div>
                </section>
                @endif
            @else
                <div class="w-full h-20 mt-24 flex flex-col justify-between items-center">
                    <span>Please log in to save items in the basket.</span>
                    <x-util.button class="w-32 h-10 font-bold bg-violet-700 hover:bg-violet-800" type="a" href="/login">Log In</x-util.button>
                </div>
            @endif
    </main>
</x-layouts.layout>
