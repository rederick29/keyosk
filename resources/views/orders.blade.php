{{--
Orders page to be used as a view on website.

Author(s): Kai Chima : Main Developer
--}}

<x-layouts.account-layout :userId="$userId" :currentPage="'Orders'">
    <section class="w-full bg-white dark:bg-zinc-950">
        <div class="flex flex-col">
            @forelse ($orders as $order)
                <x-util.order-card
                    imageUrl="{{ optional($order->products->first()->images->first())->primaryImageLocation ?? 'Undefined' }}"
                    status="{{ $order->status }}" date="{{ $order->created_at }}" price="{{ $order->total_price }}">
                </x-util.order-card>
            @empty
                <p class="text-zinc-800 dark:text-white">You have no orders yet.</p>
            @endforelse
        </div>
    </section>
</x-layouts.account-layout>
