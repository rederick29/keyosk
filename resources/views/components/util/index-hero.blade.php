{{--
    Image carousel element with split layout.

    Author(s): Ben Snaith : Main Developer, Arun : Secondary Developer
--}}

@vite('resources/ts/index-hero.ts')
<section class="w-full min-h-[70vh] max-h-[70vh] pt-24 flex items-center bg-linear-to-tr from-orange-500 to-red-500 dark:from-violet-500 dark:to-pink-500 relative overflow-hidden" id="image-scroll">
    <div class="box w-full absolute  top-0 right-0"></div>
    <x-util.button type="button" class="w-fit p-2 z-10 bg-stone-200 dark:bg-zinc-800 rounded-md flex items-center justify-center absolute top-30 right-7 transition hover:bg-stone-300 dark:hover:bg-zinc-700" id="perspective-switch">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"/></svg>
    </x-util.button>
     <div class="flex-col pl-20 h-full items-center justify-center animate-fade flex" id="two-d-element">
         <x-util.logo width="600" type="div"></x-util.logo>
         <x-util.button
             type="a"
             href="/shop"
             class="w-1/3 mt-10 bg-zinc-800 dark:bg-white text-orange-400 dark:text-violet-500 hover:bg-zinc-900 dark:hover:bg-neutral-200 self-start"
         >
             Shop now
         </x-util.button>

         <img class="absolute right-52 top-64 rotate-45 scale-200" src="{{asset('storage/images/db/a75_pro_keyboard.png')}}" alt="keyboard" />
    </div>

    <div class="w-full h-1/2 mx-auto" id="three-d-element">
        <div class="flex flex-col animate-fade">
            <canvas id="canvas" class="h-full w-full"></canvas>
        </div>
    </div>
</section>

<style>
    .box {
        background-image: url("{{ asset('svgs/keyosk_k.svg') }}");
        width: calc(80px * 100);
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
