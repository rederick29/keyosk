
@vite(['resources/ts/orders-search.ts'])
<x-layouts.admin-layout currentPage="Orders">
    <section class="w-full flex gap-5 bg-white dark:bg-zinc-950">
        <div class="flex flex-col gap-5">
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
            @foreach(\App\Models\Order::all()->sortBy('status')->reverse() as $order)
                @if($order->status != \App\Models\Order\OrderStatus::Cancelled && $order->status != \App\Models\Order\OrderStatus::Completed)
                <x-order.order-card :oproducts="$order->products"
                                    imageUrl="{{ optional($order->products->first()->images->first())->primaryImageLocation ?? 'Undefined' }}"
                                    :status="$order->status" :date="$order->created_at" :price="$order->total_price" :id="$order->id" :user="$order->user_id">
                </x-order.order-card>
                @endif
            @endforeach
        </div>
        <aside class="w-full flex flex-col items-center gap-5">
            <x-util.search class="w-full" placeholder=""></x-util.search>

            <div class="w-full p-4 bg-stone-200 dark:bg-zinc-900 rounded-lg">
                <x-accordion.accordion label="Status" class="w-full">
                    <x-accordion.accordion-item :filter="''">Shipped</x-accordion.accordion-item>
                    <x-accordion.accordion-item :filter="''">Pending</x-accordion.accordion-item>
                    <x-accordion.accordion-item :filter="''">Processing</x-accordion.accordion-item>
                    <x-accordion.accordion-item :filter="''">Dispatched</x-accordion.accordion-item>
                    <x-accordion.accordion-item :filter="''">Canceled</x-accordion.accordion-item>
                    <x-accordion.accordion-item :filter="''">Completed</x-accordion.accordion-item>
                </x-accordion.accordion>
            </div>
        </aside>
    </section>
</x-layouts.admin-layout>
