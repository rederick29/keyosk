@props(['currentPage', 'userId'])
@php
    $is_stats = $currentPage === 'Stats';
    $is_users = $currentPage === 'Users';
    $is_orders = $currentPage === 'Orders';
    $is_images = $currentPage === 'Image';
    $is_products = $currentPage === 'Products';

    $statsStyle = $is_stats ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900 ring-orange-400 dark:ring-violet-700 pointer-events-none" : "bg-stone-200 dark:bg-zinc-900 ring-stone-400 dark:ring-zinc-600";
    $statsType = $is_stats ? "div" : "a";

    $usersStyle = $is_users ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900 ring-orange-400 dark:ring-violet-700 pointer-events-none" : "bg-stone-200 dark:bg-zinc-900 ring-stone-400 dark:ring-zinc-600";
    $usersType = $is_users ? "div" : "a";

    $ordersStyle = $is_orders ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900 ring-orange-400 dark:ring-violet-700 pointer-events-none" : "bg-stone-200 dark:bg-zinc-900 ring-stone-400 dark:ring-zinc-600";
    $ordersType = $is_orders ? "div" : "a";

    $productsStyle = $is_products ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900 ring-orange-400 dark:ring-violet-700 pointer-events-none" : "bg-stone-200 dark:bg-zinc-900 ring-stone-400 dark:ring-zinc-600";
    $productsType = $is_products ? "div" : "a";

    $imagesStyle = $is_images ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900 ring-orange-400 dark:ring-violet-700 pointer-events-none" : "bg-stone-200 dark:bg-zinc-900 ring-stone-400 dark:ring-zinc-600";
    $imagesType = $is_images ? "div" : "a";

    // $accountRoute = $userId == Illuminate\Support\Facades\Auth::id() ? route('account.get') : route('account.get.uid', compact('userId'));
    // $ordersRoute = $userId == Illuminate\Support\Facades\Auth::id() ? route('orders.get') : route('orders.get.uid', compact('userId'));
@endphp
<x-layouts.min-layout>
    <x-slot:title>Keyosk - Admin | {{ $currentPage }}</x-slot:title>
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

            <p class="pl-5 py-5 font-semibold">ADMIN</p>
            <x-util.button
                type="{{ $statsType }}"
                href="{{ route('admin.stats') }}"
                class="justify-start {{ $statsStyle }} w-full py-3 pl-5 rounded-none font-semibold transition-shadow duration-500"
            >
                <div
                    class="p-2 bg-stone-300 dark:bg-zinc-700 rounded-md ring-inherit ring-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/></svg>
                </div>
                Stats
            </x-util.button>
            <x-util.button
                type="{{ $usersType }}"
                href="{{ route('manage-users') }}"
                class="justify-start {{ $usersStyle }} w-full py-3 pl-5 rounded-none font-semibold transition-shadow duration-500 cursor-pointer"
            >
                <div
                    class="p-2 bg-stone-300 dark:bg-zinc-700 rounded-md ring-inherit ring-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                Users
            </x-util.button>
            <x-util.button
                type="{{ $ordersType }}"
                href="{{ route('manage-orders') }}"
                class="justify-start {{ $ordersStyle }} w-full py-3 pl-5 rounded-none font-semibold transition-shadow duration-500 cursor-pointer"
            >
                <div
                    class="p-2 bg-stone-300 dark:bg-zinc-700 rounded-md ring-inherit ring-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V6l-3-4H6zM3.8 6h16.4M16 10a4 4 0 1 1-8 0"/></svg>
                </div>
                Orders
            </x-util.button>
            <x-util.button
                type="{{ $productsType }}"
                href="{{ route('manage-products') }}"
                class="justify-start {{ $productsStyle }} w-full py-3 pl-5 rounded-none font-semibold transition-shadow duration-500 cursor-pointer"
            >
                <div
                    class="p-2 bg-stone-300 dark:bg-zinc-700 rounded-md ring-inherit ring-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                </div>
                Products
            </x-util.button>
            <x-util.button
                type="{{ $imagesType }}"
                href="{{ route('image-upload.index') }}"
                class="justify-start {{ $imagesStyle }} w-full py-3 pl-5 rounded-none font-semibold transition-shadow duration-500 cursor-pointer"
            >
                <div
                    class="p-2 bg-stone-300 dark:bg-zinc-700 rounded-md shadow-xl ring-inherit ring-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><g transform="translate(2 3)"><path d="M20 16a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h3l2-3h6l2 3h3a2 2 0 0 1 2 2v11z"/><circle cx="10" cy="10" r="4"/></g></svg>
                </div>
                Image Uploader
            </x-util.button>

            <div class="flex absolute bottom-2 left-2">
                <x-util.colormode-switcher></x-util.colormode-switcher>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('account.get') }}" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-hidden focus:ring-2 focus:ring-gray-700 rounded-lg p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"/></svg>
                    </a>
                @endif
            </div>
        </aside>

        <div
            class="w-full h-full px-10 py-10 flex justify-center overflow-y-scroll"
            id="slot"
        >
            {{ $slot }}
        </div>
    </section>
</x-layouts.min-layout>
