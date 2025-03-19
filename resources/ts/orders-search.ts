document.addEventListener("DOMContentLoaded", () => {
    const accordionList: HTMLCollectionOf<HTMLElement> = document.getElementsByClassName('accordion') as HTMLCollectionOf<HTMLElement>;
    const search = document.querySelector<HTMLInputElement>('#search-bar')!;

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('search')) {
        search.value = decodeURIComponent(urlParams.get('search')!);
    }

    const handleKeyPress = (e: KeyboardEvent) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            const url = new URL(window.location.href);

            // If the value has changed, update the URL
            if (search.value.trim() !== decodeURIComponent(urlParams.get('search') ?? '').trim()) {
                if (search.value.trim().length === 0) {
                    url.searchParams.delete('search');
                }
                url.searchParams.set('search', encodeURIComponent(search.value.trim()));
            }

            window.location.href = url.href;
        }
    }

    // Update the URL when the user presses enter in the search input
    search.addEventListener('keydown', handleKeyPress);

    const getFilter = () => {
        const url = new URL(window.location.href);
        const search = url.searchParams;
        const search_filter = search.get("status");
        return search_filter ? decodeURIComponent(search_filter) : null;
    };

    const handleFilterUpdate = (event: MouseEvent) => {
        let target = event.currentTarget;
        if (target === null || !(target instanceof HTMLElement)) {
            return;
        }

        let this_filter = target.dataset.filter;
        if (this_filter == null) {
            return;
        }

        const url = new URL(window.location.href);
        const search = url.searchParams;

        const applied_filter = getFilter();
        if (applied_filter == this_filter) {
            search.delete('status');
        } else {
            search.set('status', encodeURIComponent(this_filter));
        }
        window.location.href = url.href;
    };

    const filter = getFilter();
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

        const accordion_filters = accordion_content.querySelectorAll<HTMLElement>('.accordion-filter');
        accordion_filters.forEach((elem) => {
            elem.addEventListener('click', handleFilterUpdate);
            if (filter === elem.dataset.filter!) {
                elem.classList.add('dark:bg-white/5');
                elem.classList.remove('accordion-tick-unselected');
                elem.classList.add('accordion-tick-selected');
                elem.classList.add('bg-black/5');
            }
        });
    }})
