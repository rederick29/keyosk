@props(['orders'])
@vite(['resources/ts/orders-search.ts'])
@use(App\Models\Order\OrderStatus)
<x-layouts.admin-layout currentPage="Orders">
    <section class="w-full flex gap-5 bg-white dark:bg-zinc-950">
        <div class="w-full flex flex-col gap-5">
            <!-- header bar -->
            <section class="w-full h-fit p-6 flex items-center justify-between bg-stone-100 dark:bg-zinc-900 text-zinc-800 dark:text-gray-400 rounded-lg">
                <p class="w-[30px]">#</p>
                <p class="w-[128px]">Status</p>
                <p class="w-[200px]">Username</p>
                <p class="w-[200px]">Order Date</p>
                <p class="w-[200px]">Completion Date</p>
                <p class="w-[100px]">Total</p>
                <div class="w-[36px] bg-transparent"></div>
            </section>

            <!-- customers orders -->
            @foreach($orders as $order)
                <x-order.order-card :order="$order">
                </x-order.order-card>
            @endforeach
        </div>
        <aside class="w-1/3 flex flex-col items-center gap-5">
            <section class="w-full h-fit p-6 flex items-center justify-between bg-stone-100 dark:bg-zinc-900 text-zinc-800 dark:text-gray-400 rounded-lg">
                <p class="w-[30px] text-transparent">Filtering</p>
            </section>

            <x-util.search class="w-full" placeholder=""></x-util.search>

            <div class="w-full p-4 bg-stone-200 dark:bg-zinc-900 rounded-lg">
                <x-accordion.accordion label="Status" class="w-full">
                    <x-accordion.accordion-item :filter="OrderStatus::Shipped->value">Shipped</x-accordion.accordion-item>
                    <x-accordion.accordion-item :filter="OrderStatus::Pending->value">Pending</x-accordion.accordion-item>
                    <x-accordion.accordion-item :filter="OrderStatus::Processing->value">Processing</x-accordion.accordion-item>
                    <x-accordion.accordion-item :filter="OrderStatus::Dispatched->value">Dispatched</x-accordion.accordion-item>
                    <x-accordion.accordion-item :filter="OrderStatus::Cancelled->value">Canceled</x-accordion.accordion-item>
                    <x-accordion.accordion-item :filter="OrderStatus::Refunded->value">Refunded</x-accordion.accordion-item>
                    <x-accordion.accordion-item :filter="OrderStatus::Completed->value">Completed</x-accordion.accordion-item>
                </x-accordion.accordion>
            </div>
        </aside>
    </section>
</x-layouts.admin-layout>
