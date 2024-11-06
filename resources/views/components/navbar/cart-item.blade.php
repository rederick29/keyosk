<div class="flex flex-row gap-5 items-center w-full p-2 text-center rounded-md hover:bg-white/5 transition-colors duration-500">
    <div class="flex flex-row items-center w-fit space-x-5 font-semibold text-nowrap overflow-hidden">
        <img src="{{ $productImage }}" alt="{{ $productImage }}" width="75" height="75" class="rounded-sm" />
    </div>
    <div class="flex flex-col w-full items-center space-y-1 start-0">
        <h1 class="w-full flex font-medium ">{{ $productTitle }}</h1>
        <div class="w-full flex flex-row justify-between align-center items-center">
            <p class="font-bold">{{ $productPrice }}</p>
            <p>Qty: {{ $productQuantity }}</p>
        </div>
        <div class="w-full flex justify-start mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
        </div>
    </div>
</div>
