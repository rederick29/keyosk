@props(['product'])
<x-layouts.admin-layout :currentPage="'Edit'">
    <section class="flex w-full h-fit py-10 items-center justify-center">
        <div class="size-11/12 bg-white dark:bg-zinc-900 rounded-lg p-10 shadow-2xl">
            <!-- product preview -->
            <section class="w-full ring-[15px] ring-stone-200 dark:ring-black rounded-md">
                <x-util.product-card :product="$product" :enable_buttons="false"></x-util.product-card>
            </section>

            <hr class="w-[95%] my-10 mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <!-- product form -->
            <form class="edit-product-form" method="POST" action="{{ route('product.update.pid', ['productId' => $product->id]) }}">
                @csrf
                <div class="flex flex-col items-center gap-4">
                    <!-- product images -->
                    <section class="w-full">
                        <p class="font-semibold self-start ml-1">Product Images</p>
                        <div class="w-full h-56 p-5 overflow-x-scroll flex flex-row gap-x-10 items-center text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-hidden transition-shadow duration-500">
                            @foreach($product->images as $image)
                                <img src="{{ $image->location }}" alt="{{ $product->name }}" class="size-44 object-contain">
                            @endforeach
                        </div>
                        <div class="w-full mt-4 flex">
                            <x-util.button type="button" class="w-full mt-4 self-end bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">Replace</x-util.button>
                            <x-util.button type="button" class="w-full h-[40px] mt-4 self-end bg-transparent ring-2 ring-red-500 dark:ring-red-700 text-red-500 dark:text-red-700 hover:bg-red-500 dark:hover:bg-red-700 hover:text-zinc-800 dark:hover:text-white">Delete</x-util.button>
                        </div>
                    </section>
                    <!-- product name -->
                    <section class="w-full">
                        <x-util.form.label for="product_name">Product name:</x-util.form.label>
                        <x-util.form.input type="text" id="product_name" name="product_name" class="w-full" required value="{{ $product->name }}" />
                        <x-util.form.error name="product_name"></x-util.form.error>
                    </section>
                    <!-- product short desc -->
                    <section class="w-full">
                        <x-util.form.label for="product_short_desc">Product short description:</x-util.form.label>
                        <x-util.form.input type="text" id="product_short_desc" name="product_short_desc" class="w-full" required value="{{ $product->short_description }}" />
                        <x-util.form.error name="product_short_desc"></x-util.form.error>
                    </section>
                    <!-- product desc -->
                    <section class="w-full">
                        <x-util.form.label for="product_desc">Product description:</x-util.form.label>
                        <textarea class="block h-32 p-3 text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 w-full ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-hidden transition-shadow duration-500" id="product_desc" name="product_desc" required>{{ $product->description }}</textarea>
                        <x-util.form.error name="product_desc"></x-util.form.error>
                    </section>
                    <!-- filter selection -->
                    <section class="w-full flex gap-x-5">
                        <div class="w-1/2">
                            <p class="font-semibold self-start ml-1">Color Tags</p>
                            <div class="w-full max-h-40 overflow-y-scroll flex flex-col text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-hidden transition-shadow duration-500">
                                @foreach(\App\Models\Tag\ColourTag::all() as $tag)
                                    <x-util.form.checkbox title="{{ $tag->hex_code }}">
                                        <x-util.form.label for="tags[{{ $tag->tag->id }}][value]">{{ Str::title($tag->tag->name) }}</x-util.form.label>
                                        <x-util.form.input type="checkbox" :checked="$product->tags()->where('tag_id', $tag->tag->id)->exists()" name="tags[{{ $tag->tag->id }}][value]" class="w-fit h-fit" />
                                        <x-util.form.error name="tag[{{ $tag->tag->id }}][value]"/>
                                        <input type="hidden" name="tags[{{ $tag->tag->id }}][id]" value="{{ $tag->tag->id }}">
                                    </x-util.form.checkbox>
                                @endforeach
                            </div>
                        </div>

                        <div class="w-1/2">
                            <p class="font-semibold self-start ml-1">Attribute Tags</p>
                            <div class="w-full max-h-40 overflow-y-scroll flex flex-col text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-hidden transition-shadow duration-500">
                                @foreach(\App\Models\Tag\AttributeTag::all() as $tag)
                                    <x-util.form.checkbox title="{{ $tag->description }}">
                                        <x-util.form.label for="tags[{{ $tag->tag->id }}][value]">{{ Str::title($tag->tag->name) }}</x-util.form.label>
                                        <x-util.form.input type="checkbox" :checked="$product->tags()->where('tag_id', $tag->tag->id)->exists()" name="tags[{{ $tag->tag->id }}][value]" class="w-fit h-fit"/>
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
                            <x-util.form.input type="number" id="product_stock" name="product_stock" class="w-full" required value="{{ $product->stock }}" style="-moz-appearance: textfield" />
                            <x-util.form.error name="product_stock"></x-util.form.error>
                        </div>
                        <div class="w-1/2">
                            <x-util.form.label for="product_price">Product price:</x-util.form.label>
                            <x-util.form.input type="number" step="0.01" id="product_price" name="product_price" class="w-full" required value="{{ number_format($product->price, 2) }}" style="-moz-appearance: textfield" />
                            <x-util.form.error name="product_price"></x-util.form.error>
                        </div>
                    </section>
                    <x-util.button type="button" class="w-full mt-4 self-end bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">Apply Changes</x-util.button>
                </div>
            </form>
            <!-- cannot contain button in same form / not good idea -->
            <form method="POST" action="{{ route('product.destroy.pid', ['productId' => $product->id]) }}"> @csrf
                <x-util.button type="button" class="w-full mt-4 self-end bg-transparent ring-2 ring-red-500 dark:ring-red-700 text-red-500 dark:text-red-700 hover:bg-red-500 dark:hover:bg-red-700 hover:text-zinc-800 dark:hover:text-white">Delete Product</x-util.button>
            </form>
        </div>
    </section>
</x-layouts.admin-layout>
