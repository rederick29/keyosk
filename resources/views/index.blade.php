{{--
Index page of website.

Author(s): Ben Snaith : Main Developer, Toms Xavi : Developer
--}}

<x-layouts.layout>
    {{-- Ability to slot in a title to the layout for modularity --}}
    {{-- <x-slot:title>Example Title</x-slot:title> --}}
    <main class="min-h-screen">

        <x-util.index-hero></x-util.index-hero>

        <x-carousel.carousel></x-carousel.carousel>

        <hr class="w-2/3 mx-auto border-black/20 dark:border-white/20" />

        <section class="w-full h-fit my-20 flex flex-row justify-center items-center gap-10 animate-fade" id="what-we-do">
            <div class="size-96 overflow-hidden rounded-xl">
                <img alt="What do we do?" class="size-[400px] hover:scale-110 object-cover transition duration-500"
                    src="{{ asset('storage/images/static/index-keyboard.png') }}">
            </div>
            <div class="w-1/3 h-fit">
                <h1 class="mb-5 text-4xl">
                    What do we do?
                </h1>
                <p class="mb-5 text-black/60 dark:text-white/60">
                    Here at Keyosk we a dedicated to providing an unmatched experience to our customers, whether that be
                    through gaming, productivity or accessibility.<br><br>
                    At Keyosk we are well aware that the internet is the new frontier and we aim to provide a seamless
                    and exciting interface into this new world.
                </p>
                <a class="w-fit flex flex-row items-center font-bold underline underline-offset-8 hover:underline-offset-4 hover:text-black/60 dark:hover:text-white/60 transition-all"
                    href="/about">
                    Read more
                </a>
            </div>
        </section>

        <hr class="w-2/3 mx-auto border-black/20 dark:border-white/20" />

        <section class="w-full h-fit my-20 flex flex-col justify-center items-center gap-y-5 animate-fade duration-500">
            <div class="flex flex-row gap-x-5">
                <x-util.category-card href="/shop" href="/shop?filters=keyboard" img_src="a75_pro_keyboard.png"
                    title="Keyboards">
                    Choose from a bespoke range of Keyosk keyboards.
                </x-util.category-card>
                <x-util.category-card href="/shop" href="/shop?filters=mouse" img_src="standard_mouse.png"
                    title="Mice">
                    Choose from a bespoke range of Keyosk mice.
                </x-util.category-card>
                <x-util.category-card href="/shop?filters=mousepad" img_src="expedition_mousepad.png" title="Mousepads">
                    Choose from a bespoke range of Keyosk keyboards.
                </x-util.category-card>
            </div>
            <div class="flex flew-row gap-x-5">
                <x-util.category-card href="/shop?filters=key_switches" img_src="dark_rose_key_switches.png"
                    title="Switches">
                    Choose from a bespoke range of Keyosk keyboards.
                </x-util.category-card>
                <x-util.category-card href="/shop?filters=keycaps" img_src="scarlet_wasd_key_caps.png" title="Keycaps">
                    Choose from a bespoke range of Keyosk keyboards.
                </x-util.category-card>
            </div>
        </section>

        <hr class="w-2/3 mx-auto border-black/20 dark:border-white/20" />

        <x-testimonials.testimonials></x-testimonials.testimonials>

        @auth
            <hr class="w-2/3 mx-auto border-black/20 dark:border-white/20" />
            <section class="w-full my-20 flex flex-col items-center">
                <div class="flex flex-col text-center">
                    <h1 class="text-4xl">Make your voice heard</h1>
                    <p class="my-7 text-black/60 dark:text-white/60">Leave a review for Keyosk</p>
                </div>
                <form method="POST" class="w-2/3 flex flex-col gap-y-5">
                    <div class="flex flex-col space-y-2">
                        <x-util.form.label for="subject">Subject</x-util.form.label>
                        <x-util.form.input type="text" id="subject" name="subject" maxlength="75" required></x-util.form.input>
                    </div>
                    <div>
                        <div class="flex flex-col space-y-2">
                            <x-util.form.label for="comment">Comment</x-util.form.label>
                            <textarea class="block h-32 p-3 text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 w-full ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 resize-none focus:outline-hidden transition-shadow duration-500" id="comment" name="comment" required></textarea>
                        </div>
                    </div>
                    <x-util.button type="button" class="mt-4 rounded-md p-2 px-5 bg-orange-500  dark:bg-violet-700 text-zinc-800  dark:text-white font-semibold hover:bg-orange-600 dark:hover:bg-violet-800 text-lg hover:bg" id="submit" name="submit">Subject</x-util.button>
                </form>
            </section>

        @endauth
    </main>
</x-layouts.layout>
