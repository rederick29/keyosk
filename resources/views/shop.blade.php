<x-layouts.layout>
    <x-slot:title>Keyosk | Shop</x-slot:title>

    <main class="w-full h-fit flex justify-center pt-32 pb-[32px]">
        <div class="px-5 w-full lg:w-4/5 h-full flex flex-row justify-center space-x-5">

            <!--
                Here there will be an aside with filters etc. but this has been removed for the sake of completing MVP
            -->

            <div class="w-full h-full flex flex-col space-y-5">
                <section
                    class="w-full h-fit py-5 px-5 flex flex-wrap items-center justify-center gap-5 bg-stone-100 dark:bg-zinc-900 text-zinc-800 dark:text-gray-400 rounded-lg"
                    id="search">
                    <x-util.button class="h-fit p-3 block lg:hidden w-full md:w-20 bg-stone-200 dark:bg-zinc-800"
                        type="button">Filters
                    </x-util.button>
                    <x-util.search class="grow" placeholder="Search shop..." />
                    <section class="w-fit flex flex-row flex-wrap justify-between gap-5" id="input-elements">
                        <div class="w-full md:w-fit flex items-center justify-center flex-wrap gap-3">
                            <label class="hidden md:inline">Sort by</label>
                            <x-shop.select class="w-full md:w-64 h-full" id="sort-by">
                                <x-shop.option value="best_selling">Best Selling</x-shop.option>
                                <x-shop.option value="date">New</x-shop.option>
                                <x-shop.option value="price_low_to_high">Price: Low to High</x-shop.option>
                                <x-shop.option value="price_high_to_low">Price: High to Low</x-shop.option>
                            </x-shop.select>
                        </div>
                        <div class="flex items-center justify-center flex-wrap gap-3">
                            <label>Show per page</label>
                            <x-shop.select class="w-20 h-full" id="results-per-page">
                                <x-shop.option value="10">10</x-shop.option>
                                <x-shop.option value="25">25</x-shop.option>
                                <x-shop.option value="50">50</x-shop.option>
                            </x-shop.select>
                        </div>
                    </section>
                </section>
                <section class="w-full h-fit rounded-md" id="results">
                    @foreach ($products as $product)
                        <x-util.product-card :product="$product" />
                    @endforeach

                    <div>
                        {{ $products->links() }}
                    </div>
                </section>
            </div>
        </div>
    </main>
</x-layouts.layout>

<script nonce="{{ csp_nonce() }}">
    document.addEventListener('DOMContentLoaded', () => {
        const search = document.getElementById('search-bar');
        const sort = document.getElementById('sort-by');
        const showPerPage = document.getElementById('results-per-page');

        // Set the value of the search input element
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('search')) {
            search.value = decodeURIComponent(urlParams.get('search'));
        }

        // Set the selected index of the sort by select element
        if (urlParams.has('sort')) {
            const sortOptions = {
                'best_selling': 0,
                'date': 1,
                'price_low_to_high': 2,
                'price_high_to_low': 3
            };

            const sValue = urlParams.get('sort');
            sort.selectedIndex = sortOptions[sValue] ?? 0;
        }

        // Set the selected index of the show per page select element
        if (urlParams.has('spp')) {
            const results = ['10', '25', '50'];
            const rValue = urlParams.get('spp');
            showPerPage.selectedIndex = results.includes(rValue) ? results.indexOf(rValue) : 0;
        }

        // Update the URL with the new query parameter
        const updateUrlParam = (param, value) => {
            const url = new URL(window.location.href);
            url.searchParams.set(param, encodeURIComponent(value.trim()));
            window.location = url.href;
        };

        const handleParamUpdate = (event) => {
            const {
                id,
                value
            } = event.target;

            // Map the select element id to the query parameter
            const paramMap = {
                'sort-by': 'sort',
                'results-per-page': 'spp'
            };

            if (paramMap[id]) {
                updateUrlParam(paramMap[id], value);
            }
        };

        // Event listeners

        // Update the URL when the user presses enter in the search input
        search.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                updateUrlParam('search', search.value);
            }
        });

        // Update the URL when the user changes the value of the select elements
        sort.addEventListener('change', handleParamUpdate);
        showPerPage.addEventListener('change', handleParamUpdate);
    });
</script>
