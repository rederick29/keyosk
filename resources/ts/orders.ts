document.addEventListener("DOMContentLoaded", (): void => {

    const productCardList: HTMLCollectionOf<HTMLElement> = document.getElementsByClassName('order-card') as HTMLCollectionOf<HTMLElement>;

    for(let i: number = 0; i < productCardList.length; i++) {
        const productCard: HTMLElement = productCardList[i];
        const toggle: HTMLElement | undefined = productCard.querySelector('.toggle') as HTMLElement;
        const productCardContent: HTMLElement | undefined = productCard.querySelector('.content') as HTMLElement;

        const scrollHeight: number = productCardContent.scrollHeight;

        toggle.addEventListener('click', (): void => {
            let isOpen: boolean = productCardContent.classList.contains('content-open');

            if(isOpen)
            {
                productCardContent.classList.remove('content-open');
                productCardContent.classList.add('content-closed');
                toggle.classList.remove('toggle-open');
                toggle.classList.add('toggle-closed');
                productCardContent.style.maxHeight = '0px';
            }
            else {
                productCardContent.classList.remove('content-closed');
                productCardContent.classList.add('content-open');
                toggle.classList.remove('toggle-closed');
                toggle.classList.add('toggle-open');
                productCardContent.style.maxHeight = `${scrollHeight}px`;
            }
        })
    }
})
