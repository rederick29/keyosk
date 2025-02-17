@props(['product'])
<x-layouts.admin-layout :currentPage="'Edit'">
    <div>
        <h3>Edit Product</h3>
        <form class="edit-product-form" method="POST" action="{{ route('product.update.pid', ['productId' => $product->id]) }}"> @csrf
            <div class="flex flex-col justify-start pl-4 pt-2 pb-6 gap-2">
                <label for="product_name">Product name:</label>
                <input type="text" id="product_name" name="product_name" required value="{{ $product->name }}">
                <label for="product_short_desc">Product short description:</label>
                <input type="text" id="product_short_desc" name="product_short_desc" required value="{{ $product->short_description }}">
                <label for="product_desc">Product description:</label>
                <input type="text" id="product_desc" name="product_desc" required value="{{ $product->description }}">
                <label for="product_stock">Product stock:</label>
                <input type="number" id="product_stock" name="product_stock" required value="{{ $product->stock }}">
                <label for="product_price">Product price:</label>
                <input type="number" step="0.01" id="product_price" name="product_price" required value="{{ $product->price }}">
                <br>
                <input type="submit">
            </div>
        </form>
    </div>
</x-layouts.admin-layout>
