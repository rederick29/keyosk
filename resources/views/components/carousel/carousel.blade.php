        
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
                        <x-util.item-card 
                            image="keyboard1.jpg" 
                            alt="Keyosk Keyboard"
                            title="Keyosk Standard Keyboard"
                            description="Suitable for beginners or those who don’t utilise keyboards often."
                            buttonText="Add To Basket"
                            price="£29.99" 
                        />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card 
                            image="keyboard2.jpg" 
                            alt="Mechanical Keyboard"
                            title="Mechanical Keyboard Pro"
                            description="Designed for gaming enthusiasts with premium switches."
                            buttonText="Add To Basket"
                            price="£89.99" 
                        />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card 
                            image="keyboard3.jpg" 
                            alt="Compact Keyboard"
                            title="Compact Keyboard"
                            description="Portable and sleek, ideal for travel and minimal setups."
                            buttonText="Add To Basket"
                            price="£49.99" 
                        />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card 
                            image="keyboard4.jpg" 
                            alt="RGB Gaming Keyboard"
                            title="RGB Gaming Keyboard"
                            description="Vibrant RGB lighting for an immersive gaming experience."
                            buttonText="Add To Basket"
                            price="£59.99" 
                        />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card 
                            image="keyboard5.jpg" 
                            alt="Ergonomic Keyboard"
                            title="Ergonomic Keyboard"
                            description="Reduce wrist strain with this ergonomic design."
                            buttonText="Add To Basket"
                            price="£79.99" 
                        />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card 
                            image="keyboard6.jpg" 
                            alt="Wireless Keyboard"
                            title="Wireless Keyboard"
                            description="Cable-free design for a tidy workspace."
                            buttonText="Add To Basket"
                            price="£69.99" 
                        />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card 
                            image="keyboard7.jpg" 
                            alt="Gaming Keyboard Bundle"
                            title="Gaming Keyboard Bundle"
                            description="Includes gaming mouse and headset for an all-in-one package."
                            buttonText="Add To Basket"
                            price="£119.99" 
                        />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card 
                            image="keyboard8.jpg" 
                            alt="Ultra-Slim Keyboard"
                            title="Ultra-Slim Keyboard"
                            description="Minimalistic and ultra-thin for modern setups."
                            buttonText="Add To Basket"
                            price="£39.99" 
                        />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card 
                            image="keyboard9.jpg" 
                            alt="Multimedia Keyboard"
                            title="Multimedia Keyboard"
                            description="Dedicated media keys for enhanced productivity."
                            buttonText="Add To Basket"
                            price="£44.99" 
                        />
                    </div>
                    <div class="flex-shrink-0 w-80">
                        <x-util.item-card 
                            image="keyboard10.jpg" 
                            alt="Mechanical TKL Keyboard"
                            title="Mechanical TKL Keyboard"
                            description="Tenkeyless design for more desk space."
                            buttonText="Add To Basket"
                            price="£64.99" 
                        />
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

    <script nonce="{{ csp_nonce() }}">
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
