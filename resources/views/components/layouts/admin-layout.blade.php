@props(['currentPage', 'userId'])
@php
    $is_stats = $currentPage === 'Stats';
    $is_users = $currentPage === 'Users';
    $is_orders = $currentPage === 'Orders';

    $statsStyle = $is_stats ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900" : "bg-stone-200 dark:bg-zinc-900";
    $statsType = $is_stats ? "div" : "a";

    $usersStyle = $is_users ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900" : "bg-stone-200 dark:bg-zinc-900";
    $usersType = $is_users ? "div" : "a";

    $ordersStyle = $is_orders ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900" : "bg-stone-200 dark:bg-zinc-900";
    $ordersType = $is_orders ? "div" : "a";

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

            <hr class="w-11/12 mx-auto border-2 rounded-xl border-stone-200 dark:border-zinc-800" />

            <p class="pl-5 py-5 font-semibold">ADMIN</p>
            <x-util.button
                type="{{ $statsType }}"
                href=""
                class="justify-start {{ $statsStyle }} w-96 py-3 pl-5 rounded-none font-semibold transition-shadow duration-500"
            >
                <div
                    class="p-2 bg-zinc-700 rounded-md"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/></svg>
                </div>
                Stats
            </x-util.button>
            <x-util.button
                type="{{ $usersType }}"
                href=""
                class="justify-start {{ $usersStyle }} w-96 py-3 pl-5 rounded-none font-semibold transition-shadow duration-500"
            >
                <div
                    class="p-2 bg-zinc-700 rounded-md"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                Users
            </x-util.button>
            <x-util.button
                type="{{ $ordersType }}"
                href=""
                class="justify-start {{ $ordersStyle }} w-96 py-3 pl-5 rounded-none font-semibold transition-shadow duration-500"
            >
                <div
                    class="p-2 bg-zinc-700 rounded-md"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V6l-3-4H6zM3.8 6h16.4M16 10a4 4 0 1 1-8 0"/></svg>
                </div>
                Orders
            </x-util.button>
            <x-util.button
                type="{{ $ordersType }}"
                href=""
                class="justify-start {{ $ordersStyle }} w-96 py-3 pl-5 rounded-none font-semibold transition-shadow duration-500"
            >
                <div
                    class="p-2 bg-zinc-700 rounded-md"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><g transform="translate(2 3)"><path d="M20 16a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h3l2-3h6l2 3h3a2 2 0 0 1 2 2v11z"/><circle cx="10" cy="10" r="4"/></g></svg>
                </div>
                Image Uploader
            </x-util.button>
        </aside>

        <div
            class="w-full h-full flex items-center justify-center overflow-y-scroll"
            id="slot"
        >
            {{ $slot }}
        </div>
    </section>
</x-layouts.min-layout>
