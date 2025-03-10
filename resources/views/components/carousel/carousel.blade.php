{{--
    Image carousel element.

    Author(s): Toms Xavi : Developer
--}}


<div class="p-4 mx-96 my-20">
    <div class="flex justify-center relative">
        <!-- Left Scroll Button -->
        <button id="scroll-left" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white dark:bg-zinc-900 bg-opacity-70  text-zinc-800 dark:text-white p-4 rounded-full shadow-lg hover:bg-opacity-90 transition duration-300 z-20">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <!-- Product Carousel -->
        <div id="scroll-container" class="w-10/12 p-4 mx-10 flex overflow-x-hidden space-x-4 scrollbar-hide">
            <!-- Debugging: Check if $products is empty -->
            @if(\App\Models\Product::all()->count() > 0)
                @foreach(\App\Models\Product::latest()->take(10)->get() as $product)
                    <div class="shrink-0 w-80">
                        <x-util.item-card
                            :id="$product->id"
                            :image="$product->primaryImageLocation()"
                            :alt="$product->name"
                            :title="$product->name"
                            :description="$product->short_description"
                            :price="$product->price"
                        />
                    </div>
                @endforeach
            @else
                <p class="text-red-500 text-center w-full">❌ No products found in the database.</p>
            @endif

        </div>

        <!-- Right Scroll Button -->
        <button id="scroll-right" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white dark:bg-zinc-900 bg-opacity-70 text-zinc-800 dark:text-white p-4 rounded-full shadow-lg hover:bg-opacity-90 transition duration-300 z-20">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>

<script nonce="{{ csp_nonce() }}">
    const container = document.getElementById('scroll-container');
    const scrollLeftBtn = document.getElementById('scroll-left');
    const scrollRightBtn = document.getElementById('scroll-right');

    let scrollInterval;
    let isManualScroll = false;
    const pauseTime = 4000;

    // Get the width of one card, including any gaps
    function getCardWidth() {
        const card = container.querySelector('.shrink-0');
        if (card) {
            const styles = getComputedStyle(card);
            const marginRight = parseFloat(styles.marginRight) || 0;
            return card.offsetWidth + marginRight;
        }
        return 0;
    }

    // Perform smooth scrolling by one card width
    function scrollByAmount(direction) {
        const cardWidth = getCardWidth();
        container.scrollBy({
            left: direction * cardWidth,
            behavior: 'smooth',
        });
    }

    // Align to the nearest card after a manual scroll
    function alignToNearestCard() {
        const cardWidth = getCardWidth();
        const currentScroll = container.scrollLeft;
        const nearestCardIndex = Math.round(currentScroll / cardWidth);
        const targetScroll = nearestCardIndex * cardWidth;
        container.scrollTo({
            left: targetScroll,
            behavior: 'smooth',
        });
    }

    // Start auto-scrolling
    function startAutoScroll() {
        if (!isManualScroll) {
            scrollInterval = setInterval(() => {
                scrollByAmount(1);
            }, pauseTime);
        }
    }

    // Stop and reset auto-scroll
    function resetAutoScroll() {
        clearInterval(scrollInterval);
        isManualScroll = true;
        setTimeout(() => {
            isManualScroll = false;
            startAutoScroll();
        }, pauseTime);
    }

    // Attach event listeners to buttons
    scrollLeftBtn.addEventListener('click', () => {
        resetAutoScroll();
        scrollByAmount(-1);
    });

    scrollRightBtn.addEventListener('click', () => {
        resetAutoScroll();
        scrollByAmount(1);
    });

    // Align to the nearest card after manual scroll ends
    container.addEventListener('scroll', () => {
        if (isManualScroll) return;
        clearTimeout(container.alignTimeout);
        container.alignTimeout = setTimeout(alignToNearestCard, 200);
    });

    // Initialize auto-scroll
    startAutoScroll();


</script>

