
{{--
    Cart menu component to appear in navbar

    Author(s): Ben Snaith : Main Developer

    TODO: fix menu progagation issue
--}}

<div class="relative">
    <div class="p-2 flex flex-row items-center justify-center rounded-md hover:bg-black/5 dark:hover:bg-white/5 ring-orange-500 dark:ring-violet-700 transition-colors duration-300" id="cart-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="20.5" r="1"/><circle cx="18" cy="20.5" r="1"/><path d="M2.5 2.5h3l2.7 12.4a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.6l1.6-8.4H7.1"/></svg>
        <div class="hidden lg:inline md:inline">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </div>
    </div>
    {{-- Drop down menu --}}
    <div class="dropdown-hide w-[100vw] md:w-[32rem] h-fit top-24 md:top-12 lg:top-12 right-0" id="cart-dropdown">
        <div class="flex flex-col items-center min-h-[100%] m-4">
            <div class="px-2 mb-4 font-bold text-xl w-full justify-start">Shopping Basket</div>
            <div class="flex flex-col w-full p-5 mt-0 bg-white dark:bg-zinc-950 min-h-[30vh] max-h-[30vh] overflow-y-scroll shadow-inner rounded-xl">
                @if(Auth::check())
                    <div class="flex flex-col gap-5">
                        @if(!Auth::user()->cart)
                            <span>Cart Empty.</span>
                        @else
                            @foreach(Auth::user()->cart->products as $product)
                                <x-navbar.cart-item productImage="{{ $product->primaryImageLocation() ?? 'Undefined' }}" productTitle="{{ $product->name }}" productPrice="{{ $product->price }}" productQuantity="{{ Auth::user()->cart->getProductQuantity($product->id) }}"/>
                            @endforeach
                        @endif
                    </div>
                @else
                    <div class="w-full h-20 mt-24 flex flex-col justify-between items-center">
                        <span>Please log in to save items in the basket.</span>
                        <x-util.button class="w-32 h-10 font-bold bg-orange-500 dark:bg-violet-700 hover:bg-orange-600 dark:hover:bg-violet-800" type="a" href="/login">Log In</x-util.button>
                    </div>
                @endif
            </div>
            <div class="h-[12px]"></div>
            <x-util.button  type="a" href="/" class="bg-orange-500 dark:bg-violet-700 text-zinc-800 dark:text-white hover:bg-orange-600 dark:hover:bg-violet-800">Checkout</x-util.button>
            <div class="h-[12px]"></div>
            <x-util.button  type="a" href="/cart" class="bg-transparent ring-2 ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 hover:bg-orange-500 dark:hover:bg-violet-800 hover:text-zinc-800 dark:hover:text-white">View cart</x-util.button>
        </div>
    </div>
</div>

