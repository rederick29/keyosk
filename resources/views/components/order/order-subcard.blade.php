{{--
Products card for each order.

Author(s): Kai Chima : Main Developer
--}}

@props(['prodstatus', 'prodimg', 'productname', 'prodprice', 'prodquant'])
<div {{ $attributes->merge(['class' => 'w-full py-3 flex flex-row gap-5 items-center text-center rounded-lg']) }}>
    <div class="flex items-center justify-center overflow-hidden">
        <img src="{{ $prodimg }}" alt="{{ $prodimg }}" width="100" height="100" class="size-12 rounded-xs object-contain" />
    </div>
    <div class="w-full flex flex-row gap-2 space-y-5">
        <p>{{ $prodquant . 'x' }}</p>
        <div class="flex flex-col w-full items-center start-0">
            <p class="w-full flex font-bold text-xl">{{ $productname }}</p>
            <div class="flex flex-row justify-start items-center w-full gap-2">
                <p class="flex flex-row text-black/30 dark:text-white/30">
                    £
                    <span class="">{{ number_format($prodprice, 2) }}</span>
                </p>
            </div>
        </div>
        @if($prodstatus == \App\Models\Order\OrderStatus::Completed)
            <x-util.button type="button" class="w-1/3  self-end bg-transparent ring-2 ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 hover:bg-orange-500 dark:hover:bg-violet-800 hover:text-zinc-800 dark:hover:text-white">Review Product</x-util.button>
        @endif
    </div>
</div>
