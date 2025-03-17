document.addEventListener("DOMContentLoaded", () => {
const accordionList: HTMLCollectionOf<HTMLElement> = document.getElementsByClassName('accordion') as HTMLCollectionOf<HTMLElement>;

for(let i: number = 0; i < accordionList.length; i++) {
    const accordion: HTMLElement = accordionList[i];
    const toggle: HTMLElement | undefined = accordion.querySelector('.toggle') as HTMLElement;
    const accordion_content: HTMLElement | undefined = accordion.querySelector('.content') as HTMLElement;

    // NOTE: .querySelector() does not like '-' for some reason
    const scrollHeight: number = accordion_content.scrollHeight;

    toggle.addEventListener('click', (event: MouseEvent): void => {
        let isOpen: boolean = accordion.classList.contains('accordion-open');

        if(isOpen) {
            accordion.classList.remove('accordion-open');
            accordion.classList.add('accordion-closed');
            accordion.style.maxHeight = '24px';
        }
        else {
            accordion.classList.remove('accordion-closed');
            accordion.classList.add('accordion-open');
            // 34px is the height of the label with the mb-[10px]
            accordion.style.maxHeight = `${scrollHeight + 34}px`;
        }
    });
}})
