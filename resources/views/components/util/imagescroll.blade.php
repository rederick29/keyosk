
{{--
    Image carousel element.

    Author(s): Ben Snaith : Main Developer
--}}

<section class="relative w-full min-h-[70vh] pt-24 flex items-center bg-linear-to-tr from-orange-500 to-red-500 dark:from-violet-500 dark:to-pink-500 overflow-hidden" id="image-scroll">
    <div class="absolute box w-full top-0"></div>
    <div
        class="h-full mx-32 flex flex-col anim-right"
    >
        <x-util.logo width="600" type="div"></x-util.logo>
        <x-util.button
            type="a"
            href="/shop"
            class="w-1/3 mt-10 bg-zinc-800 dark:bg-white text-orange-400 dark:text-violet-500 hover:bg-zinc-900 dark:hover:bg-neutral-200"
        >
            Shop now
        </x-util.button>
    </div>
</section>

<style>
    .box {
        background-image: url("{{ asset('svgs/keyosk_k.svg') }}");
        height: calc(80px * 20);
        animation: slide 4s linear infinite;
    }

    @keyframes slide {
        from {
            transform: translateY(0px) translateX(0px);
        }
        to {
            transform: translateY(80px) translateX(80px);
        }
    }
</style>
