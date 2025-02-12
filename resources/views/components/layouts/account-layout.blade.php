@props(['currentPage', 'userId'])
@php
    $is_orders = $currentPage === 'Orders';
    $orderLinkBg = $is_orders ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900" : "bg-stone-200 dark:bg-zinc-800";
    $orderElemType = $is_orders ? "div" : "a";
    $accountLinkBg = !$is_orders ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900" : "bg-stone-200 dark:bg-zinc-800";
    $accountElemType = !$is_orders ? "div" : "a";
    $accountRoute = $userId == Illuminate\Support\Facades\Auth::id() ? route('account.get') : route('account.get.uid', compact('userId'));
    $ordersRoute = $userId == Illuminate\Support\Facades\Auth::id() ? route('orders.get') : route('orders.get.uid', compact('userId'));
@endphp
<x-layouts.layout>
    <x-slot:title>Keyosk | {{ $currentPage }}</x-slot:title>

    <section
        class="w-full h-screen pt-24 flex items-center"
    >
        <aside
            class="w-1/4 h-full flex flex-col gap-x-5 bg-stone-200 dark:bg-zinc-800"
        >
            <p class="pl-5 py-5 font-semibold">GENERAL</p>
            <x-util.button
                type="{{ $accountElemType }}"
                href="{{ $accountRoute }}"
                class="{{ $accountLinkBg }} w-96 py-3 rounded-none font-semibold transition-shadow duration-500"
            >
                Account
            </x-util.button>
            <x-util.button
                type="{{ $orderElemType }}"
                href="{{ $ordersRoute }}"
                class="{{ $orderLinkBg }} w-96 py-3 rounded-none font-semibold transition-shadow duration-500"
            >
                Orders
            </x-util.button>
        </aside>

        <div
            class="w-full h-full px-10 py-10 overflow-y-scroll"
        >
            {{ $slot }}
        </div>
    </section>
</x-layouts.layout>
