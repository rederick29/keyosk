<div class="relative">
    <div class="flex flex-row items-center justify-center p-2 rounded-lg ring-orange-500 dark:ring-violet-700 hover:bg-black/5 dark:hover:bg-white/5 transition-colors duration-300" id="shop">
        <p>Shop</p>
        <div class="arrow transition duration-300 hidden lg:inline md:inline">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </div>
    </div>
    {{-- Drop down menu --}}
    {{-- Desktop and Medium View --}}
    <div class="scale-0 border-2 border-neutral-400 bg-white dark:bg-zinc-900 rounded-sm fixed md:absolute lg:absolute md:rounded-lg lg:rounded-lg shadow-2xl w-[100vw] md:w-72 lg:w-[680px] h-fit top-24 left-0 md:top-13 lg:top-13 md:left-0 lg:left-0" id="shop-dropdown">
        <div class="w-full flex flex-col items-start space-y-1 min-h-[100%] m-4 gap-y-3">
            <section class="w-full pr-8">
                <x-util.search class="w-full [&_input]:dark:bg-zinc-700" placeholder=""></x-util.search>
            </section>

            <section class="w-full flex">
                <section class="w-2/3 pr-5 flex flex-col">
                    <x-util.button type="a" class="items-start justify-normal">
                        All
                    </x-util.button>
                    <x-util.button type="a" class="items-start justify-normal">
                        Best Selling
                    </x-util.button>
                    <x-util.button type="a" class="items-start justify-normal">
                        Sale
                    </x-util.button>
                </section>

                <section class="w-2/3 px-5 flex flex-col border-x-4 border-zinc-700">
                    <x-util.button type="a" class="items-start justify-normal">
                        Keyboards
                    </x-util.button>
                    <x-util.button type="a" class="items-start justify-normal">
                        Keycaps
                    </x-util.button>
                    <x-util.button type="a" class="items-start justify-normal">
                        Switches
                    </x-util.button>
                    <x-util.button type="a" class="items-start justify-normal">
                        Mice
                    </x-util.button>
                    <x-util.button type="a" class="items-start justify-normal">
                        Mousepads
                    </x-util.button>
                </section>

                <section class="w-2/3 px-5 mr-3 flex flex-col">
                    <x-util.button type="a" class="items-start justify-normal">
                        Gamers
                    </x-util.button>
                    <x-util.button type="a" class="items-start justify-normal">
                        Professionals
                    </x-util.button>
                    <x-util.button type="a" class="items-start justify-normal">
                        Enthusiasts
                    </x-util.button>
                    <x-util.button type="a" class="items-start justify-normal">
                        Kawaii >.<
                    </x-util.button>
                </section>
            </section>
        </div>
    </div>
</div>
