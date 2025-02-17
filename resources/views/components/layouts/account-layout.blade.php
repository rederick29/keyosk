@props(['currentPage', 'userId'])
@php
    $is_account = $currentPage === 'Account';
    $is_orders = $currentPage === 'Orders';
    $is_wishlist = $currentPage === "Wishlist";

    $orderStyle = $is_orders ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900 ring-orange-400 dark:ring-violet-700 pointer-events-none" : "bg-stone-200 dark:bg-zinc-900 ring-stone-400 dark:ring-zinc-600";
    $orderType = $is_orders ? "div" : "a";

    $accountStyle = $is_account ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900 ring-orange-400 dark:ring-violet-700 pointer-events-none" : "bg-stone-200 dark:bg-zinc-900 ring-stone-400 dark:ring-zinc-600";
    $accountType = $is_account ? "div" : "a";

    $wishlistStyle = $is_wishlist ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900 ring-orange-400 dark:ring-violet-700 pointer-events-none" : "bg-stone-200 dark:bg-zinc-900 ring-stone-400 dark:ring-zinc-600";
    $wishlistType = $is_wishlist ? "div" : "a";

    $accountRoute = $userId == Illuminate\Support\Facades\Auth::id() ? route('account.get') : route('account.get.uid', compact('userId'));
    $ordersRoute = $userId == Illuminate\Support\Facades\Auth::id() ? route('orders.get') : route('orders.get.uid', compact('userId'));
@endphp
<x-layouts.min-layout>
    <x-slot:title>Keyosk | {{ $currentPage }}</x-slot:title>

    <section
        class="w-full h-screen flex items-center"
    >
        <aside
            class="w-1/4 h-full flex flex-col gap-x-5 bg-stone-200 dark:bg-zinc-900"
        >
            <div class="py-5 self-center">
                <x-util.logo type="a" width="250" href="/"></x-util.logo>
            </div>

            <hr class="w-11/12 mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <p class="pl-5 py-5 font-semibold">GENERAL</p>
            <x-util.button
                type="{{ $accountType }}"
                href="{{ $accountRoute }}"
                class="justify-start {{ $accountStyle }} w-full py-3 pl-5 rounded-none font-semibold transition-shadow duration-500"
            >
                <div
                    class="p-2 bg-stone-300 dark:bg-zinc-700 rounded-md ring-inherit ring-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
                Account
            </x-util.button>
            <x-util.button
                type="{{ $orderType }}"
                href="{{ $ordersRoute }}"
                class="justify-start {{ $orderStyle }} w-full py-3 pl-5 rounded-none font-semibold transition-shadow duration-500"
            >
                <div
                    class="p-2 bg-stone-300 dark:bg-zinc-700 rounded-md ring-inherit ring-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                </div>
                Orders
            </x-util.button>
            <x-util.button
                type="{{ $wishlistType }}"
                href=""
                class="justify-start {{ $wishlistStyle }} w-full py-3 pl-5 rounded-none font-semibold transition-shadow duration-500"
            >
                <div
                    class="p-2 bg-stone-300 dark:bg-zinc-700 rounded-md ring-inherit ring-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </div>
                Wishlist
            </x-util.button>

            <div class="flex absolute bottom-2 left-2">
                <x-util.colormode-switcher></x-util.colormode-switcher>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('stats') }}" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-700 rounded-lg p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"/></svg>
                    </a>
                @endif
            </div>
        </aside>

        <div
            class="w-full h-full px-10 py-10 overflow-y-scroll"
            id="slot"
        >
            {{ $slot }}
        </div>
    </section>
</x-layouts.min-layout>
