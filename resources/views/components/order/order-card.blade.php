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
                <p class="w-32 p-1 flex justify-center bg-green-700 rounded-md font-bold text-white">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Shipped)
                <p class="w-32 p-1 flex justify-center bg-orange-600 rounded-md font-bold text-white">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Dispatched)
                <p class="w-32 p-1 flex justify-center bg-blue-700 rounded-md font-bold text-white">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Processing)
                <p class="w-32 p-1 flex justify-center bg-pink-700 rounded-md font-bold text-white">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Pending)
                <p class="w-32 p-1 flex justify-center bg-yellow-400 rounded-md font-bold text-white">{{ strtoupper($status->value) }}</p>
                @break
            @case(\App\Models\Order\OrderStatus::Cancelled)
                <p class="w-32 p-1 flex justify-center bg-red-700 rounded-md font-bold text-white">{{ strtoupper($status->value) }}</p>
                @break
        @endswitch

        <p class="flex flex-row items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            {{ $date->format('d M Y, h:i') }}
        </p>

        <!-- Price -->
        <p>£{{ number_format($price, 2) }}</p>

        <x-util.button type="button" onclick="view({{ $id }})" class="toggle toggle-closed w-fit bg-stone-200 dark:bg-zinc-800 hover:bg-black/10 dark:hover:bg-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </x-util.button>
    </section>

    <!-- dropdown content -->
    <section class="w-full items-center content content-closed overflow-hidden">
        <div class="w-full px-1 pb-1 flex flex-col gap-y-5 pt-10">
            <hr class="w-[99%] mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <div class="flex gap-x-20">
                <div class="w-1/2 flex flex-col gap-y-1">
                <!-- products -->
                @foreach ($oproducts as $oprod)
                    <x-order.order-subcard
                        :productname="$oprod->name" :desc="$oprod->description" :prodprice="$oprod->price" :prodimg="$oprod->primaryImageLocation() ?? 'Undefined'" :prodstatus="$status">
                    </x-order.order-subcard>
                @endforeach
                </div>

                <!-- addr / email / buttons -->
                <div class="w-1/2 flex flex-col justify-between">
                    <div class="flex flex-col gap-y-5 font-bold">
                        <p class="flex items-center gap-x-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            johndoe@email.com
                        </p>

                        <div class="flex items-start gap-x-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <div>
                                <p>1 The Road</p>
                                <p>Kensington</p>
                                <p>London</p>
                                <p>NW1 000</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 flex flex-col gap-y-5">
                        <x-util.button type="a" class="bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800 font-bold overflow-hidden [&>span]:translate-x-4 hover:[&>span]:translate-x-0 [&>svg]:translate-y-10 hover:[&>svg]:translate-y-0 [&>*]:transition">
                            <span>Query Order</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        </x-util.button>

                        @if($status != \App\Models\Order\OrderStatus::Completed && $status != \App\Models\Order\OrderStatus::Shipped)
                            <x-util.button type="a" class="bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-800 text-white font-bold  overflow-hidden [&>span]:translate-x-4 hover:[&>span]:translate-x-0 [&>svg]:translate-y-10 hover:[&>svg]:translate-y-0 [&>*]:transition">
                                <span>Cancel</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                            </x-util.button>
                        @endif

                        @if($status == \App\Models\Order\OrderStatus::Completed)
                            <x-util.button type="a" class="bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-800 text-white font-bold  overflow-hidden [&>span]:translate-x-4 hover:[&>span]:translate-x-0 [&>svg]:translate-y-10 hover:[&>svg]:translate-y-0 [&>*]:transition">
                                <span>Request a refund</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                            </x-util.button>
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

    .toggle {
        transition: transform 300ms ease;
    }

    .toggle-closed svg {
        transform: rotate(0deg);
        transition: transform 300ms ease;
    }

    .toggle-open svg {
        transform: rotate(180deg);
        transition: transform 300ms ease;
    }
</style>



