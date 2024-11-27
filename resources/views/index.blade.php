<x-layouts.layout>
    <main class="h-screen">
        <x-util.imagescroll></x-util.imagescroll>

        <div class="p-4">
            <div class="relative">
                <button
                    id="scroll-left"
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-zinc-900 bg-opacity-70 text-white p-4 rounded-full shadow-lg hover:bg-opacity-90 transition duration-300 z-20"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <div
                    id="scroll-container"
                    class="flex overflow-x-auto space-x-4 p-4 bg-zinc-900 rounded-lg scrollbar-hide"
                >
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card />
                    </div>
                </div>

                <button
                    id="scroll-right"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-zinc-900 bg-opacity-70 text-white p-4 rounded-full shadow-lg hover:bg-opacity-90 transition duration-300 z-20"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </main>

    <script>
        const container = document.getElementById('scroll-container');
        const scrollLeftBtn = document.getElementById('scroll-left');
        const scrollRightBtn = document.getElementById('scroll-right');

        let scrollInterval;
        let isManualScroll = false;
        const scrollAmount = 2;
        const pauseTime = 3000;

        function performScroll() {
            container.scrollBy({ left: 80 * scrollAmount, behavior: 'smooth' });
        }

        function startLoopingScroll() {
            if (!isManualScroll) {
                scrollInterval = setInterval(() => {
                    performScroll();
                    clearInterval(scrollInterval);
                    setTimeout(() => {
                        startLoopingScroll();
                    }, pauseTime);
                }, 3000);
            }
        }

        startLoopingScroll();

        scrollLeftBtn.addEventListener('click', () => {
            clearInterval(scrollInterval);
            container.scrollBy({ left: -300, behavior: 'smooth' });
            isManualScroll = true;
            setTimeout(() => {
                isManualScroll = false;
                startLoopingScroll();
            }, 3000);
        });

        scrollRightBtn.addEventListener('click', () => {
            clearInterval(scrollInterval);
            container.scrollBy({ left: 300, behavior: 'smooth' });
            isManualScroll = true;
            setTimeout(() => {
                isManualScroll = false;
                startLoopingScroll();
            }, 3000);
        });
    </script>

    <style>
        #scroll-container::-webkit-scrollbar {
            display: none;
        }

        #scroll-container {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</x-layouts.layout>
