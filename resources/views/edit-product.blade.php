@props(['product'])
<x-layouts.admin-layout :currentPage="'Edit'">
    <section class="flex w-full h-fit py-10 items-center justify-center">
        <div class="size-11/12 bg-white dark:bg-zinc-900 rounded-lg p-10 shadow-2xl">
            <!-- product preview -->
            <section class="w-full ring-[15px] ring-black rounded-md">
                <x-util.product-card :product="$product"></x-util.product-card>
            </section>

            <hr class="w-[95%] my-10 mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <!-- product form -->
            <form class="edit-product-form" method="POST" action="{{ route('product.update.pid', ['productId' => $product->id]) }}">
                @csrf
                <div class="flex flex-col justify-start gap-2">
                    <label for="product_name">Product name:</label>
                    <x-util.form.input type="text" id="product_name" name="product_name" required value="{{ $product->name }}" />
                    <label for="product_short_desc">Product short description:</label>
                    <x-util.form.input type="text" id="product_short_desc" name="product_short_desc" required value="{{ $product->short_description }}" />
                    <label for="product_desc">Product description:</label>
                    <x-util.form.input type="text" id="product_desc" name="product_desc" required value="{{ $product->description }}" />
                    <label for="product_stock">Product stock:</label>
                    <x-util.form.input type="number" id="product_stock" name="product_stock" required value="{{ $product->stock }}" />
                    <label for="product_price">Product price:</label>
                    <x-util.form.input type="number" step="0.01" id="product_price" name="product_price" required value="{{ $product->price }}" />
                    <br>
                    <input type="submit">
                </div>
            </form>
        </div>
    </section>
</x-layouts.admin-layout>
