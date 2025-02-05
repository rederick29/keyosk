{{--
    Search bar element.

    Author(s): Ben Snaith : Main Developer
--}}

@props(['placeholder'])
<form {{ $attributes->merge(['class' => 'inline-flex']) }}>
    <div class="relative flex flex-row w-full">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-zinc-800 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input type="search" id="search-bar"
            class="block w-full p-3 h-full ps-10 text-sm outline-none placeholder:text-zinc-800  placeholder:dark:text-white text-zinc-800 dark:text-neutral-100 rounded-lg bg-stone-200 dark:bg-zinc-800 hover:ring hover:ring-orange-500 dark:hover:ring-violet-700/75 focus:border-zinc-700 font-normal transition-all duration-500"
            placeholder="{{ $placeholder }}" />
        <!-- <button type="submit" class="text-white absolute end-2.5 bottom-2 bg-violet-700 hover:bg-violet-800 focus:outline-none focus:ring-violet-300 rounded-lg text-sm px-4 py-2 shadow-lg transition-colors duration-300">Search</button> -->
    </div>
</form>
