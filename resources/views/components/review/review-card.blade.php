@props(['review'])
<div class="bg-stone-100 dark:bg-zinc-900 rounded-md p-6 flex flex-col gap-4 mb-6 relative hover:ring-4 hover:ring-orange-500 dark:hover:ring-violet-700/75 transition-all duration-300">
    <!-- Product Image and Info Container -->
    <div class="w-full flex items-center gap-4">
        <!-- Product Image -->
        <a href="/product/{{ $review->product->id }}" class="size-40 bg-stone-200 dark:bg-zinc-900 rounded-md flex items-center justify-center overflow-hidden">
            <img src="{{ $review->product->primaryImageLocation() ?? '#' }}" alt="{{ $review->product->name." Image" }}" class="h-full w-full object-contain">
        </a>

        <!-- Product Details -->
        <div class="w-full flex flex-col">
            <h1 class="text-2xl font-semibold text-zinc-800 dark:text-white mb-2">{{ $review->product->name }}</h1>

            <hr class="w-full mx-auto my-5 border-2 rounded-xl border-stone-300 dark:border-zinc-800" />

            <h1 class="text-xl">{{ $review->subject }}</h1>

            <p>{{ $review->rating }}</p>

            <p class="py-5">{{ $review->comment }}</p>

            <form action="{{ route('review.delete', ['reviewId' => $review->id]) }}" method="POST" class="w-full flex justify-end">
                @csrf
                @method('DELETE')
                <x-util.button type="button" class="w-1/6 bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-800 text-white font-semibold">Delete Account</x-util.button>
            </form>
        </div>
    </div>
</div>
