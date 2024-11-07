{{--
    Component for items that appear in the Shopping Basket on the website.

    Author(s): Ben Snaith: Main developer

    TODO:
--}}

<div class="flex flex-row gap-5 items-center w-full p-2 text-center rounded-lg hover:bg-white/5 transition-colors duration-500">
    <div class="flex flex-row items-center w-fit space-x-5 font-semibold text-nowrap overflow-hidden">
        <img src="{{ $productImage }}" alt="{{ $productImage }}" width="100" height="100" class="rounded-sm" />
    </div>
    <div class="flex flex-col w-full items-center space-y-1 start-0">
        <h1 class="w-full flex font-medium ">{{ $productTitle }}</h1>
        <div class="w-full flex flex-row justify-between align-center items-center">
            <p class="font-bold">£{{ $productPrice }}</p>
            <p class="text-xs">Qty: {{ $productQuantity }}</p>
        </div>
        <button class="w-full flex justify-end mt-1 text-xs text-red-600 hover:underline hover:text-red-700">
            remove
        </button>
    </div>
</div>
