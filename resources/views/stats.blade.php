{{--
    Stats Page

    Author(s): intns : Main Developer
--}}

@vite('resources/ts/admin-stats.ts')
<x-layouts.admin-layout currentPage="Stats">
    <section class="w-full">
        <div class="w-full flex flex-col gap-y-5">
            <div class="w-full flex gap-x-5">
                <div class="w-1/2 h-fit p-5 flex flex-col items-center justify-center bg-stone-100 dark:bg-zinc-800 rounded-md">
                    <div class="text-center">
                        <h2 class="text-3xl font-semibold mb-2">Best Selling Products</h2>
                        <h3 class="text-m font-semibold italic">Hover over segments to view sales figures. Click to view product page.</h3>
                    </div>
                    <div class="w-full flex items-center justify-center">
                        <div id="product-sales-chart" class="w-[320px] h-96 flex justify-center"></div>
                        <div id="product-legend" class="w-fit flex flex-col"></div>
                    </div>
                </div>

                <div class="w-1/2 h-fit p-5 flex flex-col items-center justify-center bg-stone-100 dark:bg-zinc-800 rounded-md">
                    <div class="text-center">
                        <h2 class="text-3xl font-semibold mb-2">Worst Selling Products</h2>
                        <h3 class="text-m font-semibold italic">Hover over segments to view sales figures. Click to view product page.</h3>
                    </div>
                    <div class="w-full flex items-center justify-center">
                        <div id="product-sales-chart2" class="w-[320px] h-96 flex justify-center"></div>
                        <div id="product-legend2" class="w-fit flex flex-col"></div>
                    </div>
                </div>
            </div>

            <div class="w-full h-fit p-5 flex flex-col items-center justify-center bg-stone-100 dark:bg-zinc-800 rounded-md">
                <h2 class="text-3xl font-semibold mb-2">User Spending Chart</h2>
                <div class="w-full flex items-center justify-center">
                    <div id="user-spending-chart" class="w-[700px] h-96"></div>
                    <div id="user-spending-legend" class="w-fit flex flex-col"></div>
                </div>
            </div>


{{--            <div class="flex flex-col items-center justify-center">--}}
{{--                <h2 class="text-3xl font-semibold mb-2">Worst Selling Products</h2>--}}
{{--                <h3 class="text-m font-semibold italic">Hover over bars to view sales figures. Click to view product page.</h3>--}}
{{--                <div id="product-sales-chart2" class="w-full max-w-3xl h-96 mx-auto"></div>--}}
{{--                <div id="product-legend2" class="flex flex-wrap justify-center gap-4 mt-4"></div>--}}
{{--            </div>--}}
        </div>
    </section>
</x-layouts.admin-layout>
