{{--
    Index page of website.

    Author(s): Ben Snaith : Main Developer, Toms Xavi : Developer
--}}

<x-layouts.layout>
    {{-- Ability to slot in a title to the layout for modularity --}}
    {{-- <x-slot:title>Example Title</x-slot:title> --}}
    <main class="min-h-screen">
        <x-util.imagescroll></x-util.imagescroll>

        <section
            class="w-full h-fit my-20 flex flex-row justify-center items-center gap-x-5 anim-right"
        >
            <div
                class="max-w-96 bg-stone-200 dark:bg-zinc-900 hover:ring-4 ring-orange-500 dark:ring-violet-700 overflow-hidden transition-shadow duration-500 cursor-default rounded-xl"
            >
                <div
                    class="p-5"
                >
                    <h1
                        class="mb-3 text-3xl font-semibold"
                    >
                        Custom Keyboards
                    </h1>
                    <p
                        class="text-black/60 dark:text-white/60"
                    >
                        Choose from a bespoke selection of custom keyboards carefully created to fit your specific needs.
                    </p>
                    <a
                        href="/about"
                        class="w-fit mt-3 flex flex-row items-center font-bold underline underline-offset-8 hover:underline-offset-4 hover:text-black/60 dark:hover:text-white/60 transition-all"
                    >
                        Learn more
                    </a>
                </div>
            </div>
            <div
                class="max-w-96 bg-stone-200 dark:bg-zinc-900 hover:ring-4 ring-orange-500 dark:ring-violet-700 overflow-hidden transition-shadow duration-500 cursor-default rounded-xl"
            >
                <div
                    class="p-5"
                >
                    <h1
                        class="mb-3 text-3xl font-semibold"
                    >
                        Custom Keyboards
                    </h1>
                    <p
                        class="text-black/60 dark:text-white/60"
                    >
                        Choose from a bespoke selection of custom keyboards carefully created to fit your specific needs.
                    </p>
                    <a
                        href="/about"
                        class="w-fit mt-3 flex flex-row items-center font-bold underline underline-offset-8 hover:underline-offset-4 hover:text-black/60 dark:hover:text-white/60 transition-all"
                    >
                        Learn more
                    </a>
                </div>
            </div>
            <div
                class="max-w-96 bg-stone-200 dark:bg-zinc-900 hover:ring-4 ring-orange-500 dark:ring-violet-700 overflow-hidden transition-shadow duration-500 cursor-default rounded-xl"
            >
                <div
                    class="p-5"
                >
                    <h1
                        class="mb-3 text-3xl font-semibold"
                    >
                        Custom Keyboards
                    </h1>
                    <p
                        class="text-black/60 dark:text-white/60"
                    >
                        Choose from a bespoke selection of custom keyboards carefully created to fit your specific needs.
                    </p>
                    <a
                        href="/about"
                        class="w-fit mt-3 flex flex-row items-center font-bold underline underline-offset-8 hover:underline-offset-4 hover:text-black/60 dark:hover:text-white/60 transition-all"
                    >
                        Learn more
                    </a>
                </div>
            </div>
        </section>

        <hr class="w-2/3 mx-auto border-black/20 dark:border-white/20" />

        <x-carousel.carousel></x-carousel.carousel>

        <hr class="w-2/3 mx-auto border-black/20 dark:border-white/20" />

        <section
            class="w-full h-fit my-20 flex flex-row justify-center items-center gap-10"
            id="what-we-do"
        >
            <img src="https://placehold.co/400x400" alt="" class="rounded-xl">
            <div
                class="w-1/3 h-fit"
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
