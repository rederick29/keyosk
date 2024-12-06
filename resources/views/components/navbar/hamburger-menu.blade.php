
{{--
    Hamburger menu component to appear in navbar in mobile view (sm:)

    Author(s): Ben Snaith : Main Developer

    TODO: implement dropdown menu
--}}

<div class="lg:hidden md:hidden max-w-[40%]">
    <div class="flex flex-row lg:hidden md:hidden items-center space-x-0.5 p-2 rounded-md hover:bg-white/5 ring-violet-700 transition-colors duration-300" id="hamburger">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    </div>
    {{-- Mobile Hamburger Menu --}}
    <div class="dropdown-hide fixed sm:block md:hidden lg:hidden w-[100vw] h-fit top-24 right-0" id="hamburger-dropdown">
        <div class="flex flex-col items-center space-y-1 min-h-[100%] m-4">
            <x-util.button  type="a" href="/" class="">
                Shop
            </x-util.button>
            <x-util.button  type="a" href="/" class="">
                Best Selling
            </x-util.button>
            <x-util.button  type="a" href="/" class="">
                Sale
            </x-util.button>
        </div>
    </div>
</div>

