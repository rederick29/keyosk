document.addEventListener("DOMContentLoaded", (): void => {
    const container: HTMLElement = document.getElementById('scroll-container') as HTMLElement;
    const scrollLeftBtn: HTMLElement = document.getElementById('scroll-left') as HTMLElement;
    const scrollRightBtn: HTMLElement = document.getElementById('scroll-right') as HTMLElement;

    // Track if a scroll animation is in progress
    let isScrolling = false;
    let currentPosition = 0;
    let cardWidth = 0;
    let totalOriginalCards = 0;

    // Clone all product cards for the infinite effect
    const setupInfiniteCarousel = (): void => {
        const productCards = Array.from(container.querySelectorAll('.product-card'));
        totalOriginalCards = productCards.length;

        // If no products, exit early
        if (totalOriginalCards === 0) return;

        // Clone all cards and append them to create the infinite effect
        productCards.forEach(card => {
            const clone = card.cloneNode(true) as HTMLElement;
            container.appendChild(clone);
        });

        // Calculate card width after cloning
        cardWidth = getCardWidth();

        // Set initial position to first card
        snapToCard(0);
    };

    // Calculate the width of a single card
    const getCardWidth = (): number => {
        const card: HTMLElement | null = container.querySelector('.product-card');
        if (card) {
            return card.offsetWidth + 8;
        }
        return 0;
    };

    // Set up container sizing - show maximum 4 cards at once
    const setupContainerSize = (): void => {
        cardWidth = getCardWidth();
        if (cardWidth) {
            // Set container width to be a multiple of card width to prevent partial cards
            const visibleCards = window.innerWidth > 1200 ? 4 :
                window.innerWidth > 768 ? 3 :
                    window.innerWidth > 480 ? 2 : 1;
            container.style.maxWidth = `${cardWidth * visibleCards}px`;
            container.style.width = `${cardWidth * visibleCards}px`;
        }
    };

    // Snap to a specific card position
    const snapToCard = (cardIndex: number): void => {
        if (cardIndex < 0) {
            // If trying to go before the first card, jump to the cloned set
            cardIndex = totalOriginalCards - 1;
        } else if (cardIndex >= totalOriginalCards) {
            // If trying to go past the last original card, jump to the first card
            cardIndex = 0;
        }

        // Update current position
        currentPosition = cardIndex;

        // Scroll to exact card position without animation
        container.scrollLeft = cardIndex * cardWidth;
    };

    // Scroll to next or previous card with animation
    const scrollToCard = (direction: number): void => {
        // Prevent multiple scrolls at once
        if (isScrolling) return;
        isScrolling = true;

        // Calculate target position
        const targetPosition = currentPosition + direction;

        // Scroll with animation
        container.scrollTo({
            left: targetPosition * cardWidth,
            behavior: "smooth"
        });

        // After animation completes
        setTimeout(() => {
            // Check if we need to snap to another position
            if (targetPosition < 0 || targetPosition >= totalOriginalCards) {
                snapToCard(targetPosition);
            } else {
                currentPosition = targetPosition;
            }
            isScrolling = false;
        }, 300); // Match this with your CSS transition time
    };

    // Initialize everything
    const init = (): void => {
        setupInfiniteCarousel();
        setupContainerSize();

        // Set up event listeners
        scrollLeftBtn.addEventListener("click", (): void => {
            scrollToCard(-1);
        });

        scrollRightBtn.addEventListener("click", (): void => {
            scrollToCard(1);
        });

        // Auto-scroll every 5 seconds, but only if not currently scrolling
        setInterval(() => {
            if (!isScrolling && !container.matches(':hover')) {
                scrollToCard(1);
            }
        }, 5000);

        // Handle window resize
        window.addEventListener('resize', () => {
            // Recalculate dimensions
            setupContainerSize();
            // Re-snap to current card to fix position
            snapToCard(currentPosition);
        });

        // stop the padding bs
        container.scrollBy({
            left: cardWidth - 4,
            behavior: "instant"
        })
    };

    // Start everything
    init();
});
