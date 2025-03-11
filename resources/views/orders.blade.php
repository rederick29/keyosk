{{--

Orders page to be used as a view on website.

Author(s): Kai Chima : Main Developer

--}}

<x-layouts.account-layout :userId="$userId" :currentPage="'Orders'">
    <section class="w-full bg-white dark:bg-zinc-950">
        <div class="flex flex-col gap-5">

            <!-- header bar -->
            <section class="w-full h-fit p-6 flex items-center justify-between bg-stone-100 dark:bg-zinc-900 text-zinc-800 dark:text-gray-400 rounded-lg">
                <p class="w-[30px]">#</p>
                <p class="w-[128px]">Status</p>
                <p class="w-[200px]">Order Date</p>
                <p class="w-[200px]">Completion Date</p>
                <p class="w-[100px]">Total</p>
                <div class="w-[36px] bg-transparent"></div>
            </section>

            <!-- customers orders -->
            @forelse ($orders->sortBy('status') as $order)
                <x-order.order-card :oproducts="$order->products"
                    imageUrl="{{ optional($order->products->first()->images->first())->primaryImageLocation ?? 'Undefined' }}"
                    :status="$order->status" :date="$order->created_at" :price="$order->total_price" :id="$order->id" :user="$order->user_id">
                </x-order.order-card>
            @empty
                <p class="text-zinc-800 dark:text-white">You have no orders yet.</p>
            @endforelse
        </div>
    </section>
</x-layouts.account-layout>
