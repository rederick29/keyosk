<div {{ $attributes->merge(['class' => 'carousel-container justify-items-center']) }}>
    {{ $slot }}
    <button type="button" class="absolute flex justify-center items-center lg:ml-5 lg:top-1/2 top-1/4 rounded-sm overflow-hidden" onclick="changeSlides(-1)">
        <svg class="w-8 h-10 border-4 opacity-25 hover:opacity-75 border-zinc-400 text-gray-800 dark:text-white bg-zinc-400"
             aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13" />
        </svg>
    </button>
    <button type="button" class="absolute flex justify-center items-center lg:ml-10 lg:top-1/2 lg:right-1/2 top-1/4 right-1 rounded-sm overflow-hidden" onclick="changeSlides(1)">
        <svg class="w-8 h-10 border-4 opacity-25 hover:opacity-75 border-zinc-400 text-gray-800 dark:text-white bg-zinc-400"
             aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 13 5.7-5.326a.909.909 0 0 0 0-1.348L1 1" />
        </svg>
    </button>
</div>

<style>
    .slides {
        display: none;
    }
</style>

<script nonce={{ csp_nonce() }}>
    let index = 0;
    let slides = document.getElementsByClassName("slides");
    let length = slides.length
    displaySlides(index);

    function changeSlides(x) {
        index += x
        displaySlides(index);
    }

    function displaySlides(x) {
        if (x > length - 1) {
            index = 0;
        }
        if (x < 0) {
            index = length - 1
        }
        for (let i = 0; i < length; i++) {
            slides[i].style.display = "none";
        }
        slides[index].style.display = "block";
    }
</script>
