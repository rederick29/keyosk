<x-layouts.admin-layout :currentPage="'Add'">
    <section class="flex w-full h-fit py-10 items-center justify-center">
        <div class="size-11/12 bg-white dark:bg-zinc-900 rounded-lg p-10 shadow-2xl">
            <!-- product preview -->
            <section class="w-full ring-[15px] ring-black rounded-md">

            </section>

            <hr class="w-[95%] my-10 mx-auto border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <!-- product form -->
            <form class="edit-product-form" method="POST" action="">
                @csrf
                <div class="flex flex-col items-center gap-4">
                    <section class="w-full">
                        <x-util.form.label for="product_name">Product name:</x-util.form.label>
                        <x-util.form.input type="text" id="product_name" name="product_name" class="w-full" required />
                        <x-util.form.error name="product_name"></x-util.form.error>
                    </section>
                    <section class="w-full">
                        <x-util.form.label for="product_short_desc">Product short description:</x-util.form.label>
                        <x-util.form.input type="text" id="product_short_desc" name="product_short_desc" class="w-full" required />
                        <x-util.form.error name="product_short_desc"></x-util.form.error>
                    </section>
                    <section class="w-full">
                        <x-util.form.label for="product_desc">Product description:</x-util.form.label>
                        <textarea class="block h-32 p-3 text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 w-full ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-hidden transition-shadow duration-500" id="product_desc" name="product_desc" required></textarea>
                        <x-util.form.error name="product_desc"></x-util.form.error>
                    </section>
                    <!-- filter selection -->
                    <section class="w-full flex gap-x-5">

                        <div>
                            <p class="font-semibold self-start ml-1">Color Tags</p>
                            <div class="w-1/2 max-h-40 overflow-y-scroll flex flex-col text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-hidden transition-shadow duration-500">
                                <x-util.form.checkbox>
                                    <x-util.form.label for="">Black</x-util.form.label>
                                    <x-util.form.input type="checkbox" id="" name="" class="w-fit h-fit" required />
                                </x-util.form.checkbox>
                                <x-util.form.checkbox>
                                    <x-util.form.label for="">White</x-util.form.label>
                                    <x-util.form.input type="checkbox" id="" name="" class="h-fit" required />
                                </x-util.form.checkbox>
                                <x-util.form.checkbox>
                                    <x-util.form.label for="">Red</x-util.form.label>
                                    <x-util.form.input type="checkbox" id="" name="" class="h-fit" required />
                                </x-util.form.checkbox>
                                <x-util.form.checkbox>
                                    <x-util.form.label for="">Blue</x-util.form.label>
                                    <x-util.form.input type="checkbox" id="" name="" class="h-fit" required />
                                </x-util.form.checkbox>
                                <x-util.form.checkbox>
                                    <x-util.form.label for="">Green</x-util.form.label>
                                    <x-util.form.input type="checkbox" id="" name="" class="h-fit" required />
                                </x-util.form.checkbox>
                                <x-util.form.checkbox>
                                    <x-util.form.label for="">RGB</x-util.form.label>
                                    <x-util.form.input type="checkbox" id="" name="" class="h-fit" required />
                                </x-util.form.checkbox>
                            </div>
                        </div>

                        <div class="w-1/2 max-h-40 overflow-y-scroll flex flex-col text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-hidden transition-shadow duration-500">
                            <p class="font-semibold self-start ml-1">Attribute Tags</p>
                            <x-util.form.checkbox>
                                <x-util.form.label for="">Keyboards</x-util.form.label>
                                <x-util.form.input type="checkbox" id="" name="" class="w-fit h-fit" required />
                            </x-util.form.checkbox>
                            <x-util.form.checkbox>
                                <x-util.form.label for="">Mice</x-util.form.label>
                                <x-util.form.input type="checkbox" id="" name="" class="h-fit" required />
                            </x-util.form.checkbox>
                            <x-util.form.checkbox>
                                <x-util.form.label for="">Switches</x-util.form.label>
                                <x-util.form.input type="checkbox" id="" name="" class="h-fit" required />
                            </x-util.form.checkbox>
                            <x-util.form.checkbox>
                                <x-util.form.label for="">Keycaps</x-util.form.label>
                                <x-util.form.input type="checkbox" id="" name="" class="h-fit" required />
                            </x-util.form.checkbox>
                            <x-util.form.checkbox>
                                <x-util.form.label for="">Mousepads</x-util.form.label>
                                <x-util.form.input type="checkbox" id="" name="" class="h-fit" required />
                            </x-util.form.checkbox>
                        </div>
                    </section>
                    <section class="w-full flex gap-x-5">
                        <div class="w-1/2">
                            <x-util.form.label for="product_stock">Product stock:</x-util.form.label>
                            <x-util.form.input type="number" id="product_stock" name="product_stock" class="w-full" required style="-moz-appearance: textfield" />
                            <x-util.form.error name="product_stock"></x-util.form.error>
                        </div>
                        <div class="w-1/2">
                            <x-util.form.label for="product_price">Product price:</x-util.form.label>
                            <x-util.form.input type="number" step="0.01" id="product_price" name="product_price" class="w-full" required style="-moz-appearance: textfield" />
                            <x-util.form.error name="product_price"></x-util.form.error>
                        </div>
                    </section>
                    <x-util.button type="button" class="w-full mt-4 self-end bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">Add Product</x-util.button>
                </div>
            </form>
        </div>
    </section>
</x-layouts.admin-layout>
