<x-layouts.layout>
    <x-slot:title>Keyosk | Keyosk+</x-slot:title>

    <div class="w-full min-h-screen pt-32 flex items-center justify-center bg-linear-to-tr from-orange-500 to-red-500 dark:from-violet-500 dark:to-pink-500 relative overflow-hidden">
        <div class="box-1 absolute right-0 top-[120px] bg-blend-multiply"></div>
        <div class="box-2 absolute left-0 top-[240px]"></div>
        <div class="box-3 absolute right-0 top-[360px]"></div>
        <div class="box-4 absolute left-0 top-[480px]"></div>
        <div class="box-5 absolute right-0 top-[600px]"></div>
        <div class="box-6 absolute left-0 top-[720px]"></div>

        <section class="w-full h-full z-20 flex flex-col items-center">
            <div class="flex relative">
                <x-util.logo class="mx-auto" type="div" width="1000"></x-util.logo>
                <div>
                    <svg class="size-40 absolute -right-30 -top-10" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </div>
            </div>
        </section>
    </div>
</x-layouts.layout>

<style>
    .box-1 {
        background-image: url("{{ asset('svgs/keyosk_full.svg') }}");
        width: calc(480px * 20);
        height: 80px;
        animation: slide-right 4s linear infinite;
        opacity: 0.5;
        filter: hue-rotate(90deg) saturate(150%) brightness(1.2);
    }
    .box-2 {
        background-image: url("{{ asset('svgs/keyosk_full.svg') }}");
        width: calc(480px * 20);
        height: 80px;
        animation: slide-left 4s linear infinite;
        opacity: 0.5;
    }
    .box-3 {
         background-image: url("{{ asset('svgs/keyosk_full.svg') }}");
         width: calc(480px * 20);
         height: 80px;
         animation: slide-right 4s linear infinite;
         opacity: 0.5;
     }
    .box-4 {
        background-image: url("{{ asset('svgs/keyosk_full.svg') }}");
        width: calc(480px * 20);
        height: 80px;
        animation: slide-left 4s linear infinite;
        opacity: 0.5;
    }
    .box-5 {
        background-image: url("{{ asset('svgs/keyosk_full.svg') }}");
        width: calc(480px * 20);
        height: 80px;
        animation: slide-right 4s linear infinite;
        opacity: 0.5;
    }
    .box-6 {
        background-image: url("{{ asset('svgs/keyosk_full.svg') }}");
        width: calc(480px * 20);
        height: 80px;
        animation: slide-left 4s linear infinite;
        opacity: 0.5;
    }

    @keyframes slide-right {
        from {
            transform: translateX(0px);
        }
        to {
            transform: translateX(480px);
        }
    }

    @keyframes slide-left {
        from {
            transform: translateX(0px);
        }
        to {
            transform: translateX(-480px);
        }
    }
</style>
