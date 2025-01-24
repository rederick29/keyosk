{{--
    Admin Homepage

    Author(s): Erick Vilcica: Main Developer
--}}
<x-layouts.layout>
    <x-slot:title>Product Image Uploader</x-slot:title>
    <div class="w-fit h-fit flex pt-32 pb-[32px] flex-col">
    <h3>Product Image Uploader</h3>
    <form class="image-uploader" method="POST" enctype="multipart/form-data"
          action="{{ route('image-upload.store_db') }}"> @csrf
        <div class="flex flex-col justify-start pl-4 pt-2 pb-6 gap-2">
    <label for="product_id">Select the product:</label>
    <select class="product-select" id="product_id" name="product_id" required>
        @foreach(\App\Models\Product::all() as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
    </select>
            <label for="p_image">Upload an image:</label>
    <input type="file" accept="image/*" id="p_image" name="image" required>
            <label for="priority">Pick image priority:</label>
    <input type="number" id="priority" name="priority"><br>
    <input type="submit">
        </div>
    </form>
        <hr>
    <h3>Static Image Uploader</h3>
        <form class="image-uploader" method="POST" enctype="multipart/form-data"
              action="{{ route('image-upload.store_static') }}"> @csrf
            <div class="flex flex-col justify-start pl-4 pt-2 pb-6 gap-2">
                <label for="s_image">Upload an image:</label>
            <input type="file" accept="image/*" id="s_image" name="image" required>
                <label for="filename">Choose a filename for the image:</label>
            <input type="text" id="filename" name="filename">
            <input type="submit">
        </div>
        </form>
    </div>
</x-layouts.layout>
