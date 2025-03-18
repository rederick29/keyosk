
@props(['title', 'description', 'href'])
<div class="max-w-96 bg-stone-200 dark:bg-zinc-900 hover:ring-4 ring-orange-500 dark:ring-violet-700 overflow-hidden transition-shadow duration-500 cursor-default rounded-xl">
    <div class="p-5 bg-stone-300 dark:bg-zinc-950">
    <img src="{{asset('storage/images/db/a75_pro_keyboard.png')}}" alt="Category Image">
    </div>
    <div class="p-5">
        <h1 class="mb-3 text-3xl font-semibold">
            {{ $title }}
        </h1>
        <p class="min-h-14 text-black/60 dark:text-white/60 overflow-ellipsis">
            {{ $slot }}
        </p>
        <a
            href="{{ $href }}"
            class="w-fit mt-3 flex flex-row items-center font-bold underline underline-offset-8 hover:underline-offset-4 hover:text-black/60 dark:hover:text-white/60 transition-all"
        >
            Shop Now
        </a>
    </div>
</div>
