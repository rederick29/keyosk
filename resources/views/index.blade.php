{{--
    Index page of website.

    Author(s): Ben Snaith : Main Developer, Toms Xavi : Developer
--}}

<x-layouts.layout>
    {{-- Ability to slot in a title to the layout for modularity --}}
    {{-- <x-slot:title>Example Title</x-slot:title> --}}
    <main class="min-h-screen">

        <x-util.index-hero></x-util.index-hero>

        <section class="w-full h-fit my-20 px-3 md:px-0 flex flex-col justify-center items-center gap-y-5 animate-fade duration-500">
            <div class="flex flex-col md:flex-row gap-y-5 md:gap-y-0 md:gap-x-5">
                <x-util.category-card
                    img_src="a75_pro_keyboard.png"
                    title="Keyboards"
                    href="/shop"
                    href="/shop?filters=keyboard"
                >
                    Choose from a bespoke range of Keyosk keyboards.
                </x-util.category-card>
                <x-util.category-card
                    img_src="standard_mouse.png"
                    title="Mice"
                    href="/shop"
                    href="/shop?filters=mouse"
                >
                    Choose from a bespoke range of Keyosk mice.
                </x-util.category-card>
                <x-util.category-card
                    img_src="expedition_mousepad.png"
                    title="Mousepads"
                    href="/shop?filters=mousepad"
                >
                    Choose from a bespoke range of Keyosk keyboards.
                </x-util.category-card>
            </div>
            <div class="flex flex-col md:flew-row gap-y-5 md:gap-y-0 md:gap-x-5">
                <x-util.category-card
                    img_src="dark_rose_key_switches.png"
                    title="Switches"
                    href="/shop?filters=key_switches"
                >
                    Choose from a bespoke range of Keyosk keyboards.
                </x-util.category-card>
                <x-util.category-card
                    img_src="scarlet_wasd_key_caps.png"
                    title="Keycaps"
                    href="/shop?filters=keycaps"
                >
                    Choose from a bespoke range of Keyosk keyboards.
                </x-util.category-card>
            </div>
        </section>

        <hr class="w-2/3 mx-auto border-black/20 dark:border-white/20" />

        <x-carousel.carousel></x-carousel.carousel>

        <hr class="w-2/3 mx-auto border-black/20 dark:border-white/20" />

        <section
            class="w-full h-fit px-5 md:px-0 my-20 flex flex-col md:flex-row justify-center items-center gap-10 animate-fade"
            id="what-we-do"
        >
            <div class="size-80 md:size-96 overflow-hidden rounded-xl">
                <img src="{{ asset('storage/images/static/index-keyboard.png') }}" alt="What do we do?" class="size-[400px] hover:scale-110 object-cover transition duration-500">
            </div>
            <div
                class="w-full md:w-1/3 h-fit"
            >
                <h1
                    class="mb-5 text-4xl"
                >
                    What do we do?
                </h1>
                <p
                    class="mb-5 text-black/60 dark:text-white/60"
                >
                    Here at Keyosk we a dedicated to providing an unmatched experience to our customers, whether that be through gaming, productivity or accessibility.<br><br>
                    At Keyosk we are well aware that the internet is the new frontier and we aim to provide a seamless and exciting interface into this new world.
                </p>
                <a
                    href="/about"
                    class="w-fit flex flex-row items-center font-bold underline underline-offset-8 hover:underline-offset-4 hover:text-black/60 dark:hover:text-white/60 transition-all"
                >
                    Read more
                </a>
            </div>
        </section>

        <hr class="w-2/3 mx-auto border-black/20 dark:border-white/20" />

        <x-testimonials.testimonials></x-testimonials.testimonials>
    </main>
</x-layouts.layout>
