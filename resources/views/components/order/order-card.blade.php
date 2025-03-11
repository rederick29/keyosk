{{--
Order-card component.

Author(s): Toms Xavi: Developer, Kai Chima: Sub-Developer
--}}

@props(['oproducts', 'date', 'status', 'price', 'id'])

@vite("resources/ts/orders.ts")
<div class="order-card bg-stone-100 dark:bg-zinc-900 rounded-md p-6 flex flex-col shadow-lg hover:ring-4 hover:ring-orange-500 dark:hover:ring-violet-700/75 transition-all duration-300">
    <!-- Product Image and Info Container -->
    <section class="flex items-center justify-between gap-4 font-bold">

        <p class="font-bold">#{{ $id }}</p>

        @switch($status)
            @case(\App\Models\Order\OrderStatus::Completed)
                <p class="w-32 p-1 flex justify-center bg-green-700 rounded-md font-bold">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Shipped)
                <p class="w-32 p-1 flex justify-center bg-orange-600 rounded-md font-bold">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Dispatched)
                <p class="w-32 p-1 flex justify-center bg-blue-700 rounded-md font-bold">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Processing)
                <p class="w-32 p-1 flex justify-center bg-pink-700 rounded-md font-bold">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Pending)
                <p class="w-32 p-1 flex justify-center bg-yellow-400 rounded-md font-bold">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Cancelled)
                <p class="w-32 p-1 flex justify-center bg-red-700 rounded-md font-bold">{{ strtoupper($status->value) }}</p>
                @break
        @endswitch

        <p class="flex flex-row items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            {{ $date->format('d M Y, h:i') }}
        </p>

        <!-- Price -->
        <p>£{{ number_format($price, 2) }}</p>

        <x-util.button type="button" onclick="view({{ $id }})" class="toggle w-fit bg-stone-200 dark:bg-zinc-800 text-white hover:bg-orange-600 dark:hover:bg-violet-800">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </x-util.button>
    </section>

    <!-- dropdown content -->
    <section class="w-full items-center content content-closed overflow-hidden">
        <div class="w-full px-1 pb-1 flex flex-col gap-y-5 pt-10">
            <hr class="w-[99%] mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <div class="flex gap-x-10">
                <div class="w-1/2 flex flex-col gap-y-5">
                <!-- products -->
                @foreach ($oproducts as $oprod)
                    <x-order.order-subcard
                        :productname="$oprod->name" :desc="$oprod->description" :prodprice="$oprod->price" :prodimg="$oprod->primaryImageLocation() ?? 'Undefined'" :prodstatus="$status">
                    </x-order.order-subcard>
                @endforeach
                </div>

                <!-- addr / email / buttons -->
                <div class="w-1/2 flex flex-col gap-y-1 justify-between">
                    <div class="font-bold">
                        <p>johndoe@email.com</p>

                        <p>1 The Road</p>
                        <p>Kensington</p>
                        <p>London</p>
                        <p>NW1 000</p>
                    </div>
                    <div class="flex flex-col gap-y-5">
                        <x-util.button type="a" class="bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">Query Order</x-util.button>

                        @if($status != \App\Models\Order\OrderStatus::Completed && $status != \App\Models\Order\OrderStatus::Shipped)
                            <x-util.button type="a" class="bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-800 text-white font-semibold">Cancel</x-util.button>
                        @endif

                        @if($status == \App\Models\Order\OrderStatus::Completed)
                            <x-util.button type="a" class="bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-800 text-white font-semibold">Request a refund</x-util.button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .content {
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: max-height 300ms ease;
    }

    .content-closed {
        max-height: 0px;
    }

    .content-open {
    }
</style>



