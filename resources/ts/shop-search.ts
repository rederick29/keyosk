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
            'best_selling': 0,
            'date': 1,
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
});
