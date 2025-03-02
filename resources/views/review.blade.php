<x-layouts.layout>
    <div class="bg-stone-200 dark:bg-zinc-900 px-6 py-20 pt-35 lg:pt-36 lg:px-40">
        <div class="max-w-full">
            <h2 class="text-4xl text-black/50 dark:text-gray-300 lg:text-5xl">Product</h2>
            <p class="text-2xl font-semibold mt-2 text-orange-500 dark:text-violet-700">Enter review below</p>
            <hr class="border-2 rounded-xl mt-3 border-stone-200 dark:border-zinc-700" />
        </div>
        <form class="mt-5">
            <div class="flex flex-row-reverse justify-end pb-2" onclick="selectRating()">
                <svg class="w-12 h-12 fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400" viewBox="0 -19 550 550" xmlns="http://www.w3.org/2000/svg">
                    <path d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" />
                </svg>
                <svg class="w-12 h-12 fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400" viewBox="0 -19 550 550" xmlns="http://www.w3.org/2000/svg">
                    <path d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" />
                </svg>
                <svg class="w-12 h-12 fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400" viewBox="0 -19 550 550" xmlns="http://www.w3.org/2000/svg">
                    <path d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" />
                </svg>
                <svg class="w-12 h-12 fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400" viewBox="0 -19 550 550" xmlns="http://www.w3.org/2000/svg">
                    <path d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" />
                </svg>
                <svg class="w-12 h-12 fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400" viewBox="0 -19 550 550" xmlns="http://www.w3.org/2000/svg">
                    <path d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" />
                </svg>
            </div>
            <h3 class="text-2xl my-2 text-black/50 dark:text-gray-300">Subject</h3>
            <input type="text"
                class="w-3/4 py-1 rounded-md text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                maxlength="75"></input>
            <h3 class="text-2xl my-2 text-black/50 dark:text-gray-300">Comment</h3>
            <textarea rows="5"
                class="w-full py-1 rounded-md text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"></textarea>
        </form>
    </div>
</x-layouts.layout>

<script>
    selectRating(){
        const stars = document.querySelectorAll('svg');
        stars.forEach(star => {
            star.addEventListener('click', () => {
                star.classList.add('fill-yellow-400');
            });
        });
    }
</script>