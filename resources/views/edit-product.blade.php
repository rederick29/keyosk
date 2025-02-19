@props(['product'])
<x-layouts.admin-layout :currentPage="'Edit'">
    <section class="flex w-full h-fit py-10 items-center justify-center">
        <div class="size-11/12 bg-white dark:bg-zinc-900 rounded-lg p-10 shadow-2xl">
            <!-- product preview -->
            <section class="w-full ring-[15px] ring-black rounded-md">
                <x-util.product-card :product="$product" :enable_buttons="false"></x-util.product-card>
            </section>

            <hr class="w-[95%] my-10 mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <!-- product form -->
            <form class="edit-product-form" method="POST" action="{{ route('product.update.pid', ['productId' => $product->id]) }}">
                @csrf
                <div class="flex flex-col items-center gap-4">
                    <section class="w-full">
                        <x-util.form.label for="product_name">Product name:</x-util.form.label>
                        <x-util.form.input type="text" id="product_name" name="product_name" required value="{{ $product->name }}" />
                        <x-util.form.error name="product_name"></x-util.form.error>
                    </section>
                    <section class="w-full">
                        <x-util.form.label for="product_short_desc">Product short description:</x-util.form.label>
                        <x-util.form.input type="text" id="product_short_desc" name="product_short_desc" required value="{{ $product->short_description }}" />
                        <x-util.form.error name="product_short_desc"></x-util.form.error>
                    </section>
                    <section class="w-full">
                        <x-util.form.label for="product_desc">Product description:</x-util.form.label>
                        <textarea class="block h-32 p-3 text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 w-full ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-none transition-shadow duration-500" id="product_desc" name="product_desc" required>{{ $product->description }}</textarea>
                        <x-util.form.error name="product_desc"></x-util.form.error>
                    </section>
                    <section class="w-full flex gap-x-5">
                        <div class="w-1/2">
                            <x-util.form.label for="product_stock">Product stock:</x-util.form.label>
                            <x-util.form.input type="number" id="product_stock" name="product_stock" required value="{{ $product->stock }}" style="-moz-appearance: textfield" />
                            <x-util.form.error name="product_stock"></x-util.form.error>
                        </div>
                        <div class="w-1/2">
                            <x-util.form.label for="product_price">Product price:</x-util.form.label>
                            <x-util.form.input type="number" step="0.01" id="product_price" name="product_price" required value="{{ number_format($product->price, 2) }}" style="-moz-appearance: textfield" />
                            <x-util.form.error name="product_price"></x-util.form.error>
                        </div>
                    </section>
                    <x-util.button type="button" class="w-1/3 mt-4 self-end bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">Apply Changes</x-util.button>
                </div>
            </form>
        </div>
    </section>
</x-layouts.admin-layout>
