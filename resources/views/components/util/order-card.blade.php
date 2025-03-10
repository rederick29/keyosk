{{--
Order-card component.

Author(s): Toms Xavi: Developer, Kai Chima: Sub-Developer
--}}

@props(['oproducts', 'date', 'status', 'price', 'id'])

@vite("resources/ts/orders.ts")
<div class="order-card bg-stone-100 dark:bg-zinc-900 rounded-md p-6 flex flex-col gap-4 shadow-lg mb-6 lg:mx-20 hover:ring-4 hover:ring-orange-500 dark:hover:ring-violet-700/75 transition-all duration-300">
    <!-- Product Image and Info Container -->
    <div class="flex items-center gap-4">

        <!-- Product Details -->
        <div class="grow">
            <h3 class="product-title text-xl font-semibold text-zinc-800 dark:text-gray-300 mb-2">
                {{ strtoupper($status->value) }}</h3>
            <p class="product-description text-md text-black/50 dark:text-gray-300 leading-relaxed">
                {{ $date }}
            </p>
        </div>

        <!-- Price -->
        <div class="shrink-0">
            <span class="product-price text-2xl font-bold text-zinc-800 dark:text-gray-300">
                Total: £{{ number_format($price, 2) }}
            </span>
        </div>
    </div>

    <!-- Quantity Selector and Buttons -->
    <div class="flex items-center justify-end gap-4 mt-4">
        <!-- View Products Button -->
        <x-util.button type="button" onclick="view({{ $id }})" class="toggle bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">
            View Products
        </x-util.button>
    </div>
    <div id="{{ $id }}" class="content content-closed overflow-hidden">
        <div class="flex flex-col gap-y-5">
        @foreach ($oproducts as $oprod)
            <x-util.order-subcard
                :productname="$oprod->name" :desc="$oprod->description" :prodprice="$oprod->price" :prodimg="$oprod->primaryImageLocation() ?? 'Undefined'">
            </x-util.order-subcard>
        @endforeach
        </div>
    </div>
</div>

<style>
    .content {
        overflow: hidden;
        transition: max-height 300ms ease;
    }

    .content-closed {
        max-height: 0px;
    }

    .content-open {
    }
</style>



