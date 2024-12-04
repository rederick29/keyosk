{{--
    Component for items that appear in the Shopping Basket on the website.

    Author(s): Ben Snaith: Main developer

    TODO:
--}}

<div class="w-full flex flex-row gap-5 items-center p-2 text-center rounded-lg hover:bg-white/5 transition-colors duration-500">
    <div class="flex flex-row items-center w-fit space-x-5 font-semibold text-nowrap overflow-hidden">
        <img src="{{ $productImage }}" alt="{{ $productImage }}" width="100" height="100" class="rounded-sm" />
    </div>
    <div class="w-full">
        <div class="flex flex-col w-full items-center space-y-1 start-0">
            <h1 class="w-full flex font-bold">{{ $productTitle }}</h1>
            <p class="w-full flex font-semibold">£{{ $productPrice }}</p>
        </div>
        <div class="flex flex-row w-full justify-end items-center">

            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>

            <span>{{ $productQuantity }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        </div>
    </div>
</div>
