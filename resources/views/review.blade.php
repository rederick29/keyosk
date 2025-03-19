<x-layouts.layout>
    <div class="bg-stone-200 dark:bg-zinc-900 px-6 py-20 pt-35 lg:pt-36 lg:px-40">
        <div class="flex flex-rows justify-between items-center">
            <div class="max-w-full">
                <h2 class="text-4xl text-black/50 dark:text-gray-300 lg:text-5xl">{{ $product->name }}</h2>
                <p class="text-2xl font-semibold mt-2 text-orange-500 dark:text-violet-700">Enter review below</p>
            </div>
            <div class="product-image h-24 w-24 bg-stone-200 dark:bg-gray-800 rounded-md flex items-center justify-center overflow-hidden ">
                <img src="{{ $product->primaryImageLocation() ?? 'Undefined'}}" alt=""
                    class="h-full w-full object-cover">
            </div>
        </div>
        <hr class="border-2 rounded-xl mt-3 border-stone-400 dark:border-zinc-700" />
        <form class="mt-5" action="{{ route('product.review.store', $product->id) }}" method="POST">
            @csrf
            <div class="flex flex-row-reverse justify-end pb-2">
                <svg class="w-10 h-10 fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400 "
                    viewBox="210 0 459 873" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0L133.248 298.88L458.752 333.248L215.616 552.384L283.52 872.48L0 709.024V0Z" />
                </svg>
                <svg class="w-10 h-10  fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400 "
                    viewBox="-210 0 459 873" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M458.752 0L325.504 298.88L0 333.248L243.136 552.384L175.232 872.48L458.752 709.024V0Z" />
                </svg>
                <svg class="w-10 h-10 fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400 "
                    viewBox="210 0 459 873" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0L133.248 298.88L458.752 333.248L215.616 552.384L283.52 872.48L0 709.024V0Z" />
                </svg>
                <svg class="w-10 h-10  fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400 "
                    viewBox="-210 0 459 873" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M458.752 0L325.504 298.88L0 333.248L243.136 552.384L175.232 872.48L458.752 709.024V0Z" />
                </svg>
                <svg class="w-10 h-10 fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400 "
                    viewBox="210 0 459 873" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0L133.248 298.88L458.752 333.248L215.616 552.384L283.52 872.48L0 709.024V0Z" />
                </svg>
                <svg class="w-10 h-10  fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400 "
                    viewBox="-210 0 459 873" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M458.752 0L325.504 298.88L0 333.248L243.136 552.384L175.232 872.48L458.752 709.024V0Z" />
                </svg>
                <svg class="w-10 h-10 fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400 "
                    viewBox="210 0 459 873" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0L133.248 298.88L458.752 333.248L215.616 552.384L283.52 872.48L0 709.024V0Z" />
                </svg>
                <svg class="w-10 h-10  fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400 "
                    viewBox="-210 0 459 873" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M458.752 0L325.504 298.88L0 333.248L243.136 552.384L175.232 872.48L458.752 709.024V0Z" />
                </svg>
                <svg class="w-10 h-10 fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400 "
                    viewBox="210 0 459 873" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0L133.248 298.88L458.752 333.248L215.616 552.384L283.52 872.48L0 709.024V0Z" />
                </svg>
                <svg class="w-10 h-10  fill-gray-600 peer peer-hover:fill-yellow-400 hover:fill-yellow-400 "
                    viewBox="-210 0 459 873" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M458.752 0L325.504 298.88L0 333.248L243.136 552.384L175.232 872.48L458.752 709.024V0Z" />
                </svg>
                <input class="hidden" id="rating" name="rating" value="10">
            </div>
            <h3 class="text-2xl my-2 text-black/75 dark:text-gray-300">Subject</h3>
            <input type="text" id="subject" name="subject"
                class="w-3/4 py-1 rounded-md text-black/75 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                maxlength="75" required></input>
            <h3 class="text-2xl my-2 text-black/75 dark:text-gray-300">Comment</h3>
            <textarea rows="5" id="comment" name="comment"
                class="w-full py-1 rounded-md text-black/75 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700" required></textarea>

            <button class="mt-4 rounded-md p-2 px-5 bg-orange-500  dark:bg-violet-700 text-zinc-800  dark:text-white font-semibold hover:bg-orange-600 dark:hover:bg-violet-800 text-lg hover:bg" id="submit" name="submit">Submit</button>
        </form>
        <p class="hidden" id="num">%</p>
    </div>
</x-layouts.layout>

<script>
    let rating = 0;
    document.addEventListener('DOMContentLoaded', (e) => {
        const stars = document.querySelectorAll('svg');
        //const rating = document.getElementById('rating');

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                stars.forEach((star, i) => {
                    // var value = document.querySelector('#rating');
                    if (i >= index) {
                        star.classList.remove('fill-gray-600');
                        star.classList.add('fill-yellow-400');
                        rating = rating + 1;
                        // value.innerHTML = ""+(rating);
                    } else {
                        star.classList.remove('fill-yellow-400');
                        star.classList.add('fill-gray-600');
                    }
                });
            });
        });
        // document.getElementById('num').innerHTML = rating;
        // rating.textContent = `Yellow Stars: ${rating}`;

    });

    document.getElementById('submit').addEventListener('click', () => {
        const stars = document.querySelectorAll('svg');
        let count = 0;
        stars.forEach((star) => {
            if (star.classList.contains('fill-yellow-400')) {
                count++;
            }
        });
        document.getElementById('num').innerHTML = count - 17;
        document.getElementById('rating').value = count - 17;
        document.querySelector('form').submit();
    });
</script>