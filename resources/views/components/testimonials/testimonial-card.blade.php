<div
    class="w-96 h-fit px-5 py-7 rounded-lg bg-stone-200 dark:bg-zinc-900 hover:ring-4 ring-orange-500 dark:ring-violet-700 overflow-hidden transition-shadow cursor-default"
>
    <svg class="text-black/60 dark:text-white/60" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
    <h1
        class="my-2 text-xl font-semibold"
    >
        {{ $subject }}
    </h1>
    <p
        class="h-24 max-h-28 max-w-[95%] text-black/60 dark:text-white/60 overflow-clip"
    >
        {{ $comment }}
    </p>
    <hr
        class="mt-14 mb-5 border-black/40 dark:border-white/40"
    />
    <div
        class="flex justify-between"
    >
        <p
            class="font-semibold"
        >{{ $name }}</p>
        <p>{{ $rating }}</p>
    </div>
</div>
