{{--
    Stats Page

    Author(s): intns : Main Developer
--}}

<x-layouts.admin-layout currentPage="Stats">
    <section class="flex w-full min-h-screen items-center justify-center">
        <div class="size-11/12">
            <div class="bg-white dark:bg-zinc-900 rounded-lg p-6 shadow-2xl">
                <div class="space-y-6 text-center">
                    <h1 class="text-6xl font-bold">Admin Stats</h1>
                </div>

                <hr class="w-[95%] my-10 mx-auto border-2 rounded-xl border-stone-200 dark:border-zinc-800" />

                <div class="flex flex-col items-center justify-center space-y-8 mb-12">
                    <h2 class="text-3xl font-semibold mb-2">Best Selling Products</h2>
                    <h3 class="text-m font-semibold italic">Hover over bars to view sales figures. Click to view product page.</h3>
                    <div id="product-sales-chart" class="w-full max-w-3xl h-96 mx-auto"></div>
                    <div id="product-legend" class="flex flex-wrap justify-center gap-4 mt-4"></div>
                </div>

                <hr class="w-[95%] my-10 mx-auto border-2 rounded-xl border-stone-200 dark:border-zinc-800" />

                <div class="flex flex-col items-center justify-center space-y-8">
                    <h2 class="text-3xl font-semibold mb-2">User Spending Chart</h2>
                    <div id="user-spending-chart" class="w-full max-w-3xl h-96 mx-auto"></div>
                    <div id="user-spending-legend" class="flex flex-wrap justify-center gap-4 mt-4"></div>
                </div>

                <hr class="w-[95%] my-10 mx-auto border-2 rounded-xl border-stone-200 dark:border-zinc-800" />

                <div class="flex flex-col items-center justify-center space-y-8">
                    <h2 class="text-3xl font-semibold mb-2">Worst Selling Products</h2>
                    <h3 class="text-m font-semibold italic">Hover over bars to view sales figures. Click to view product page.</h3>
                    <div id="product-sales-chart2" class="w-full max-w-3xl h-96 mx-auto"></div>
                    <div id="product-legend2" class="flex flex-wrap justify-center gap-4 mt-4"></div>
                </div>
            </div>
        </div>
    </section>

    @vite('resources/ts/admin-stats.ts')
</x-layouts.admin-layout>
