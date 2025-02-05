@php
    $currPage = Request::is('*orders*') ? "Orders" : "Account";
    $orderLinkBg = Request::is('*orders*') ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900" : "bg-stone-200 dark:bg-zinc-800 hover:ring-4 ring-orange-500 dark:ring-violet-700";
    $orderElemType = Request::is('*orders*') ? "div" : "a";
    $accountLinkBg = Request::is('*account*') ? "bg-orange-500 hover:bg-orange-500 dark:bg-violet-900 dark:hover:bg-violet-900" : "bg-stone-200 dark:bg-zinc-800 hover:ring-4 ring-orange-500 dark:ring-violet-700";
    $accountElemType = Request::is('*account*') ? "div" : "a";
@endphp
<x-layouts.layout>
    <x-slot:title>Keyosk | {{ $currPage }}</x-slot:title>

    <section
        class="w-full h-fit pt-32 flex flex-col items-center"
    >
        <div
            class="flex flex-row gap-x-5"
        >
            <x-util.button
                type="{{ $accountElemType }}"
                href="/account"
                class="{{ $accountLinkBg }} w-96 font-semibold transition-shadow duration-500"
            >
                Account
            </x-util.button>
            <x-util.button
                type="{{ $orderElemType }}"
                href="/orders"
                class="{{ $orderLinkBg }} w-96 font-semibold transition-shadow duration-500"
            >
                Orders

            </x-util.button>
        </div>
        <div
            class="w-full h-fit px-10 py-3"
        >
            {{ $slot }}
        </div>
    </section>
</x-layouts.layout>
