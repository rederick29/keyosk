{{--
    Item cards element.

    Author(s): Toms Xavi : Developer
--}}

<div class="w-72 h-[350px] bg-stone-200 dark:bg-zinc-900 text-white rounded-lg shadow-lg overflow-hidden transform transition-transform hover:scale-105 flex flex-col border-2 border-orange-500 dark:border-violet-700">
    <div class="bg-stone-300 dark:bg-black flex justify-center items-center py-6">
        <img src="{{ $image }}" alt="{{ $alt }}" class="h-20 object-contain">
    </div>
    <div class="px-4 py-3 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold mb-2 text-center text-zinc-800 dark:text-white">{{ $title }}</h3>
        <p class="text-sm mb-3 text-center text-zinc-800 dark:text-zinc-400">{{ $description }}</p>
        <button class="mx-auto text-white bg-orange-500 dark:bg-violet-700 text-sm font-medium py-2 px-6 rounded-md shadow-md hover:bg-orange-600 hover:shadow-lg transition-transform transform hover:scale-105">
            {{ $buttonText }}
        </button>
    </div>
    <div class="px-4 py-3 flex justify-center">
        <p class="text-md font-bold text-zinc-800 dark:text-white">{{ $price }}</p>
    </div>
</div>
