{{--
    Item cards element.

    Author(s): Toms Xavi : Developer
--}}

<div class="w-72 h-[350px] bg-zinc-900 text-white rounded-lg shadow-lg overflow-hidden transform transition-transform hover:scale-105 flex flex-col border-2 border-purple-500">
    <div class="bg-black flex justify-center items-center py-6">
        <img src="{{ $image }}" alt="{{ $alt }}" class="h-20 object-contain">
    </div>
    <div class="px-4 py-3 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold mb-2 text-center">{{ $title }}</h3>
        <p class="text-sm text-zinc-400 mb-3 text-center">{{ $description }}</p>
        <button class="w-full bg-gray-700 text-white text-sm font-medium py-2 rounded hover:bg-gray-600 transition">
            {{ $buttonText }}
        </button>
    </div>
    <div class="px-4 py-3 flex justify-center">
        <p class="text-md font-bold">{{ $price }}</p>
    </div>
</div>
