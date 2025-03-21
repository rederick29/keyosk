{{--
Products card for each order.

Author(s): Kai Chima : Main Developer
--}}

@props(['prodstatus', 'prodimg', 'productname', 'prodprice', 'prodquant', 'prodid'])
<div {{ $attributes->merge(['class' => 'w-full p-3 flex flex-row gap-5 items-center text-center rounded-lg']) }}>
    <div class="w-full flex flex-col gap-2 space-y-5">
        <div class="w-full flex flex-row gap-2 items-center">
            <div class="flex items-center justify-center overflow-hidden">
                <a href="/product/{{ $prodid ?? '#' }}" class="size-10">
                    <img src="{{ $prodimg }}" alt="{{ $prodimg }}" width="100" height="100" class="size-12 rounded-xs object-contain" />
                </a>
            </div>
            <p class="flex items-center justify-center">
                {{ $prodquant }}
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </p>
            <div class="flex flex-col w-full items-center start-0">
                <p class="w-full flex font-bold text-xl">{{ $productname }}</p>
                <div class="flex flex-row justify-start items-center w-full gap-2">
                    <p class="flex flex-row text-black/30 dark:text-white/30">
                        £
                        <span class="">{{ number_format($prodprice, 2) }}</span>
                    </p>
                </div>
            </div>
            <a href="{{ route('review.index', ['productId' => $prodid]) }}">
                <x-util.button type="button" class="bg-transparent ring-2 ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 hover:bg-orange-500 dark:hover:bg-violet-800 hover:text-zinc-800 dark:hover:text-white">
                    Review
                </x-util.button>
            </a>
        </div>
        @if($prodstatus == \App\Models\Order\OrderStatus::Completed)

        @endif
    </div>

</div>
