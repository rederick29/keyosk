{{--
Orders page to be used as a view on website.

Author(s): Kai Chima : Main Developer

--}}

<x-layouts.layout>
    <x-slot:title>Keyosk | My Orders</x-slot:title>
    <div class="bg-zinc-950 py-20 h-fit w-full">
        <h2 class="pt-10 px-10 lg:px-20 text-3xl font-semibold pb-6">My Orders</h2>
        <div class=" flex flex-col lg:mx-20 mx-10">
            @foreach ($orders as $order)
                @if ($order->user->id == Auth::id())
                    <x-util.order-card imageUrl="{{$image->primaryImageLocation ?? 'Undefined'}}" status="{{$order->status}}" date="{{$order->created_at}}"
                        price="{{$order->total_price}}"></x-util.order-card>
                @endif
            @endforeach
        </div>
    </div>
</x-layouts.layout>