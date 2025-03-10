{{--
Products card for each order.

Author(s): Kai Chima : Main Developer
--}}

<div {{ $attributes->merge(['class' => 'w-full px-5 py-5 flex flex-row gap-5 items-center text-center rounded-lg bg-stone-100 bg-stone-100 dark:bg-zinc-800 hover:ring-4 hover:ring-orange-500 dark:hover:ring-violet-700/75 transition-all duration-300']) }}>
    <div class="flex items-center justify-center overflow-hidden">
        <img src="{{ $prodimg }}" alt="{{ $prodimg }}" width="100" height="100" class="size-32 rounded-xs object-contain" />
    </div>
    <div class="w-full flex flex-col space-y-5">
        <div class="flex flex-col w-full items-center start-0">
            <p class="w-full flex font-bold text-xl">{{ $productname }}</p>
            <div class="flex flex-row justify-start items-center w-full gap-2">
                <p class="flex flex-row text-black/30 dark:text-white/30">
                    £
                    <span class="">{{ $prodprice }}</span>
                </p>
            </div>
        </div>
        <x-util.button type="button" class="bg-transparent ring-2 ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 hover:bg-orange-500 dark:hover:bg-violet-800 hover:text-zinc-800 dark:hover:text-white">Review Product</x-util.button>
    </div>
</div>
