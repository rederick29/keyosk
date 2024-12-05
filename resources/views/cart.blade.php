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
                    <div class="py-2 border-b-2 border-violet-700">
                        @foreach(Auth::user()->cart->products as $product)
                            <div class="flex items-center">
                                {{ $product->stock }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                {{ $product->name }}
                            </div>
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
