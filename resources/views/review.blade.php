<x-layouts.layout>
    <div class="h-screen pt-35 pb-10 flex items-center justify-center gap-10">
        <div class="size-96 rounded-md flex items-center justify-center overflow-hidden ">
            <a href="/product/{{ $product->id ?? '#' }}" class="block h-full w-full">
                <img src="{{ $product->primaryImageLocation() ?? 'Undefined'}}" alt=""
                     class="h-full w-full object-cover"></a>
        </div>
        <div class="flex flex-col">
            <div class="max-w-full">
                <h2 class="text-4xl font-semibold text-black dark:text-white lg:text-5xl">{{ $product->name }}</h2>
            </div>
        <form class="mt-5" action="{{ route('review.store', $product->id) }}" method="POST">
            @csrf
            <div class="w-fit flex flex-row-reverse justify-end pb-2">
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
            <div>
                <x-util.form.label>Subject</x-util.form.label>
                <x-util.form.input type="text" id="subject" name="subject" maxlength="75" required></x-util.form.input>
            </div>
            <div>
                <x-util.form.label>Comment</x-util.form.label>
                <textarea class="block h-32 p-3 text-xl rounded-lg bg-stone-200 dark:bg-zinc-800 w-full ring-0 focus:ring-4 focus:ring-orange-500/50 dark:focus:ring-violet-700/75 focus:outline-hidden transition-shadow duration-500" id="comment" name="comment" required></textarea>
            </div>
            <x-util.button type="button" class="mt-4 rounded-md p-2 px-5 bg-orange-500  dark:bg-violet-700 text-zinc-800  dark:text-white font-semibold hover:bg-orange-600 dark:hover:bg-violet-800 text-lg hover:bg" id="submit" name="submit">Subject</x-util.button>
        </form>
        </div>
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
