{{--
Orders page to be used as a view on website.

Author(s): Kai Chima : Main Developer
--}}

<x-layouts.account-layout>
    <x-slot:title>Keyosk | My Orders</x-slot:title>
    <div class="bg-white dark:bg-zinc-950 h-fit w-full">
        <h2 class="pt-10 text-3xl font-semibold pb-6">My Orders</h2>
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
    </div>

</x-layouts.account-layout>
