document.addEventListener('DOMContentLoaded', () => {
    const search = document.querySelector<HTMLInputElement>('#search-bar')!;
    const sort = document.querySelector<HTMLSelectElement>('#sort-by')!;
    const showPerPage = document.querySelector<HTMLSelectElement>('#results-per-page')!;

    // Set the value of the search input element
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('search')) {
        search.value = decodeURIComponent(urlParams.get('search')!);
    }

    // Set the selected index of the sort by select element
    if (urlParams.has('sort')) {
        const sortOptions: { [key: string]: number } = {
            'date': 0,
            'best_selling': 1,
            'price_low_to_high': 2,
            'price_high_to_low': 3
        };

        const sValue = urlParams.get('sort')!;
        sort.selectedIndex = sortOptions[sValue] ?? 0;
    }

    // Set the selected index of the show per page select element
    if (urlParams.has('spp')) {
        const results = ['10', '25', '50'];
        const rValue = urlParams.get('spp')!;
        showPerPage.selectedIndex = results.includes(rValue) ? results.indexOf(rValue) : 0;
    }

    // Update the URL with the new query parameter
    const updateUrlParam = (param: string, value: string) => {
        const url = new URL(window.location.href);
        const trimmedValue = value.trim();

        if (trimmedValue.length === 0 && param === 'search') {
            url.searchParams.delete(param);
        } else {
            url.searchParams.set(param, encodeURIComponent(trimmedValue));
        }

        window.location.href = url.href;
    };

    const handleParamUpdate = (event: Event) => {
        let target = event.target as HTMLSelectElement | null;
        if (target === null) {
            return;
        }

        let id = target.id;
        let value = target.value;

        // Map the select element id to the query parameter
        const paramMap: { [key: string]: string } = {
            'sort-by': 'sort',
            'results-per-page': 'spp'
        };

        if (paramMap[id]) {
            updateUrlParam(paramMap[id], value);
        }
    };

    const getFilters = () => {
        const url = new URL(window.location.href);
        const search = url.searchParams;
        const search_filters = search.get("filters");
        return search_filters ? decodeURIComponent(search_filters).split(',') : [];
    };

    if(getFilters().length != 0) {
        const filtersDisplay = document.getElementById('filters-display');
        const filters = getFilters();

        if(filtersDisplay === null) {
            throw new Error("filter display is null");
        }
        filtersDisplay.classList.toggle('hidden');
        filtersDisplay.classList.toggle('flex');

        for(let i = 0; i < filters.length; i++) {
            let filterElement: HTMLElement = document.createElement('div');
            filterElement.className = 'clear-button w-fit h-fit p-2 flex items-center gap-2 bg-zinc-900 bg-stone-200 hover:bg-stone-300 dark:bg-zinc-900 dark:hover:bg-zinc-800 rounded-lg cursor-pointer transition-all duration-300';
            const svgHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>'
            filterElement.innerHTML = svgHTML + ' ' +  toTitleCase(filters[i]);
            filterElement.id = 'clear-' + filters[i]
            console.log(filters[i]);

            filtersDisplay.append(filterElement)
        }
    }

    const clearFilterElem: HTMLElement = document.getElementById('clear-filters') as HTMLElement;
    clearFilterElem.addEventListener("click", (): void => {
        window.location.href = '/shop';
    })

    const clearButtonList: HTMLCollectionOf<HTMLElement> = document.getElementsByClassName('clear-button') as HTMLCollectionOf<HTMLElement>;
    for(let i: number = 0; i < clearButtonList.length; i++) {
        const clearButton: HTMLElement = clearButtonList[i];

        clearButton.addEventListener("click", (): void => {
            const filterName = clearButton.id.substring(6);

            updateFilterParams(filterName, "remove");
        })
    }

    function toTitleCase(str: string): string {
        return str.replace(
            /\w\S*/g,
            text => text.charAt(0).toUpperCase() + text.substring(1).toLowerCase()
        );
    }

    const updateFilterParams = (filter: string, action: string) => {
        const url = new URL(window.location.href);
        const search = url.searchParams;

        let filters = getFilters();
        if (filters.includes(filter)) {
            if (action == "add") {
                return;
            } else if (action == "remove") {
                filters = filters.filter(e => e !== filter);
            }
        } else {
            if (action == "remove") {
                return;
            } else if (action == "add") {
                filters.push(filter);
            }
        }
        search.set('filters', encodeURIComponent(filters.join(',')));
        window.location.href = url.href;
    }

    const handleFilterUpdate = (event: MouseEvent) => {
        let target = event.currentTarget;
        if (target === null || !(target instanceof HTMLElement)) {
            return;
        }

        let filter = target.dataset.filter;
        if (filter == null) {
            return;
        }

        /* TODO:
        serverside: also check if there is any product that can match current filters + any other one
          eg, don't let users click on both "keyboard" and "mouse" if there isn't any product with both tags
        */
        const filters = getFilters();
        let action = "add";
        if (filters.includes(filter)) { action = "remove"; }
        updateFilterParams(filter, action);
    }

    // Event listeners
    const isSearchSame = () => {
        const currentSearch = decodeURIComponent(urlParams.get('search') ?? '').trim();
        return search.value.trim() === currentSearch;
    }

    const handleKeyPress = (e: KeyboardEvent) => {
        if (e.key === 'Enter') {
            e.preventDefault();

            // If the value has changed, update the URL
            if (!isSearchSame()) {
                updateUrlParam('search', search.value);
            }
        }
    }

    // Update the URL when the user presses enter in the search input
    search.addEventListener('keydown', handleKeyPress);

    // Update the URL when the user changes the value of the select elements
    sort.addEventListener('change', handleParamUpdate);
    showPerPage.addEventListener('change', handleParamUpdate);

    const accordionList: HTMLCollectionOf<HTMLElement> = document.getElementsByClassName('accordion') as HTMLCollectionOf<HTMLElement>;

    const filters = getFilters();
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
            if (filters.includes(elem.dataset.filter!)) {
                elem.classList.add('dark:bg-white/5');
                elem.classList.remove('accordion-tick-unselected');
                elem.classList.add('accordion-tick-selected');
                elem.classList.add('bg-black/5');
            }
        });
    }
});
