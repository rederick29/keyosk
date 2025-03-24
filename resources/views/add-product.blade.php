<x-layouts.admin-layout :currentPage="'Add'">
    <section class="flex w-full h-fit py-10 items-center justify-center">
        <div class="size-11/12 bg-white dark:bg-zinc-900 rounded-lg p-10 shadow-2xl">
            <!-- product form -->
            <form class="edit-product-form" method="POST" enctype="multipart/form-data" action="{{ route('product.add') }}">
                @csrf
                <div class="flex flex-col items-center gap-4">
                    <div class="w-full">
                        <div class="flex flex-row justify-between w-full">
                            <x-util.form.label for="product_image">Select primary image:</x-util.form.label>
                            <x-util.form.input type="file" accept="image/*" id="product_image" name="product_image" required />
                            <x-util.form.error name="product_image"/>
                        </div>
                        <div>
                            <img src="#" alt="Product image preview" id="upload_preview" class="w-1/2"/>
                            @vite('resources/ts/image-upload-preview.ts')
                            <script nonce="{{ csp_nonce() }}">
                                document.addEventListener("DOMContentLoaded", () => {
                                    window.previewImageUpload(document.getElementById("product_image"), document.getElementById("upload_preview"));
                                })
                            </script>
                        </div>
                    </div>
                    <section class="w-full">
                        <x-util.form.label for="product_name">Product name:</x-util.form.label>
                        <x-util.form.input type="text" id="product_name" name="product_name" class="w-full" value="{{ old('product_name') }}" required />
                        <x-util.form.error name="product_name"/>
                    </section>
                    <section class="w-full">
                        <x-util.form.label for="product_short_desc">Product short description:</x-util.form.label>
                        <x-util.form.input type="text" id="product_short_desc" name="product_short_desc" class="w-full" value="{{ old('product_short_desc') }}" required />
                        <x-util.form.error name="product_short_desc"/>
                    </section>
                    <section class="w-full">
                        <x-util.form.label for="product_desc">Product description:</x-util.form.label>
                        <textarea class="block h-32 p-3 text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 w-full ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-hidden transition-shadow duration-500" id="product_desc" name="product_desc">{{ old('product_desc') }}</textarea>
                        <x-util.form.error name="product_desc"/>
                    </section>
                    <!-- filter selection -->
                    <section class="w-full flex gap-x-5">

                        <div class="w-1/2 max-h-40 overflow-y-scroll flex flex-col text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-hidden transition-shadow duration-500">
                            <p class="font-semibold self-start ml-1 w-">Color Tags</p>
                            <div>
                                @foreach(\App\Models\Tag\ColourTag::all() as $tag)
                                    <x-util.form.checkbox title="{{ $tag->hex_code }}">
                                        <x-util.form.label for="tags[{{ $tag->tag->id }}][value]">{{ Str::title($tag->tag->name) }}</x-util.form.label>
                                        <x-util.form.input type="checkbox" name="tags[{{ $tag->tag->id }}][value]" class="w-fit h-fit" />
                                        <x-util.form.error name="tag[{{ $tag->tag->id }}][value]"/>
                                        <input type="hidden" name="tags[{{ $tag->tag->id }}][id]" value="{{ $tag->tag->id }}">
                                    </x-util.form.checkbox>
                                @endforeach
                            </div>
                        </div>

                        <div class="w-1/2 max-h-40 overflow-y-scroll flex flex-col text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-hidden transition-shadow duration-500">
                            <p class="font-semibold self-start ml-1">Attribute Tags</p>
                            <div>
                                @foreach(\App\Models\Tag\AttributeTag::all() as $tag)
                                    <x-util.form.checkbox title="{{ $tag->description }}">
                                        <x-util.form.label for="tags[{{ $tag->tag->id }}][value]">{{ Str::title($tag->tag->name) }}</x-util.form.label>
                                        <x-util.form.input type="checkbox" name="tags[{{ $tag->tag->id }}][value]" class="w-fit h-fit"/>
                                        <x-util.form.error name="tag[{{ $tag->tag->id }}][value]"/>
                                        <input type="hidden" name="tags[{{ $tag->tag->id }}][id]" value="{{ $tag->tag->id }}">
                                    </x-util.form.checkbox>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    <section class="w-full flex gap-x-5">
                        <div class="w-1/2">
                            <x-util.form.label for="product_stock">Product stock:</x-util.form.label>
                            <x-util.form.input type="number" step="1" id="product_stock" name="product_stock" class="w-full" required style="-moz-appearance: textfield" value="{{ old('product_stock') }}"/>
                            <x-util.form.error name="product_stock"></x-util.form.error>
                        </div>
                        <div class="w-1/2">
                            <x-util.form.label for="product_price">Product price:</x-util.form.label>
                            <x-util.form.input type="number" step="0.01" id="product_price" name="product_price" class="w-full" required style="-moz-appearance: textfield" value="{{ old('product_price') }}"/>
                            <x-util.form.error name="product_price"></x-util.form.error>
                        </div>
                    </section>
                    <x-util.button type="button" class="w-full mt-4 self-end bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">Add Product</x-util.button>
                </div>
            </form>
        </div>
    </section>
</x-layouts.admin-layout>
