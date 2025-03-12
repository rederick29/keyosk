{{--
    Cart menu component to appear in navbar

    Author(s): Ben Snaith : Main Developer

    TODO: fix menu progagation issue
--}}

<div class="relative">
    <div class="p-2 flex flex-row items-center justify-center rounded-md hover:bg-black/5 dark:hover:bg-white/5 ring-orange-500 dark:ring-violet-700 transition-colors duration-300"
        id="cart-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="10" cy="20.5" r="1" />
            <circle cx="18" cy="20.5" r="1" />
            <path d="M2.5 2.5h3l2.7 12.4a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.6l1.6-8.4H7.1" />
        </svg>
        <div class="hidden lg:inline md:inline">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 9l6 6 6-6" />
            </svg>
        </div>
    </div>
    {{-- Drop down menu --}}
    <div class="scale-0 border-2 border-neutral-400 bg-white dark:bg-zinc-900 rounded-sm fixed md:absolute lg:absolute md:rounded-lg lg:rounded-lg shadow-2xl w-[100vw] md:w-[32rem] h-fit top-24 md:top-12 lg:top-12 right-0" id="cart-dropdown">
        <div class="flex flex-col items-center min-h-[100%] m-4">
            <div class="px-2 mb-4 font-bold text-xl w-full justify-start">Shopping Basket</div>
            <div class="flex flex-col w-full p-5 mt-0 bg-white dark:bg-zinc-950 min-h-[30vh] max-h-[30vh] overflow-y-scroll shadow-inner rounded-xl">
                @if (Auth::check())
                    <div class="flex flex-col gap-5">
                        @if (Auth::user()->cart && Auth::user()->cart->hasProducts())
                            @vite('resources/js/cart-menu.js')
                            @foreach (Auth::user()->cart->products()->orderBy('name')->get() as $product)
                                <x-navbar.cart-item :product="$product" />
                            @endforeach
                        @endif
                    </div>

                    @if (!Auth::user()->cart || !Auth::user()->cart->hasProducts())
                        <div class="w-full h-[30vh] gap-y-3 flex flex-col justify-center items-center">
                            <span class="font-bold">Your basket looks empty... Let's change that.</span>
                        </div>
                    @endif
                @else
                    <div class="w-full h-[30vh] gap-y-3 flex flex-col justify-center items-center">
                        <span class="font-bold">Please log in to save items in the basket.</span>
                        <x-util.button
                            class="w-40 h-10 font-bold bg-orange-500 dark:bg-violet-700 hover:bg-orange-600 dark:hover:bg-violet-800"
                            type="a" href="/login">
                            Log In
                        </x-util.button>
                    </div>
                @endif
            </div>
            @if (Auth::check())
                @if (Auth::user()->cart->hasProducts())
                    <div class="h-[12px]"></div>
                    <x-util.button type="a" href="{{ route('checkout.get') }}"
                        class="bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">
                        Checkout</x-util.button>
                    <div class="h-[12px]"></div>
                    <x-util.button type="a" href="/cart"
                        class="bg-transparent ring-2 ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 hover:bg-orange-500 dark:hover:bg-violet-800 hover:text-zinc-800 dark:hover:text-white">View
                        cart</x-util.button>
                @else
                    <div class="h-[12px]"></div>
                    <x-util.button type="a" href="/shop"
                        class="bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">Continue
                        Shopping</x-util.button>
                @endif
            @endif
        </div>
    </div>
</div>
