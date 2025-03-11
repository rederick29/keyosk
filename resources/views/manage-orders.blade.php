
<x-layouts.admin-layout currentPage="Orders">
    <section class="w-full bg-white dark:bg-zinc-950">
        <div class="flex flex-col gap-5">

            <!-- header bar -->
            <section class="w-full h-fit p-6 flex items-center justify-between bg-stone-100 dark:bg-zinc-900 text-zinc-800 dark:text-gray-400 rounded-lg">
                <p>#</p>

            </section>

            <!-- customers orders -->
            @foreach(\App\Models\Order::all()->sortBy('status')->reverse() as $order)
                @if($order->status != \App\Models\Order\OrderStatus::Cancelled)
                <x-order.order-card :oproducts="$order->products"
                                    imageUrl="{{ optional($order->products->first()->images->first())->primaryImageLocation ?? 'Undefined' }}"
                                    :status="$order->status" :date="$order->created_at" :price="$order->total_price" :id="$order->id" :user="$order->user_id">
                </x-order.order-card>
                @endif
            @endforeach
        </div>
    </section>
</x-layouts.admin-layout>
