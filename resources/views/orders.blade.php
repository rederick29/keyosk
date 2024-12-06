<x-layouts.layout>
    <x-slot:title>Keyosk | My Orders</x-slot:title>
    <div class="bg-zinc-900 py-20 h-fit w-full">
        <h2 class="pt-10 px-20 text-3xl font-semibold pb-6">My Orders</h2>
        <div class="lg:w-4/5 flex flex-col">
            @foreach ($orders as $order)
                @if ($order->user->id == 2)
                    <x-util.product-card title="{{$order->status}}" description="{{$order->user->id}}"
                        price="{{$order->total_price}}"></x-util.product-card>
                @endif
            @endforeach
        </div>
    </div>
</x-layouts.layout>