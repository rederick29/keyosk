{{--
    Navbar component, to be displayed at the top of all views (besides admin)

    Author(s): Ben Snaith : Main developer

--}}

@vite(['resources/js/navbar.js'])
<nav
    class="flex flex-row fixed justify-between items-center px-5 md:px-10 lg:px-20 min-h-24 min-w-full border border-x-0 border-t-0 border-b-4 shadow-xl z-50 border-orange-500 dark:border-violet-700 bg-stone-100 dark:bg-zinc-900 ">
    {{-- Desktop Links --}}
    <div class="hidden lg:block md:block min-w-[274px]">
        <div class="hidden md:flex lg:flex lg:flex-row md:flex-row items-center space-x-10 font-medium">
            <x-navbar.shop-menu></x-navbar.shop-menu>
            <!-- TODO: decide what makes sense here -->
{{--            <a href="/shop?sort=best_selling" class="hover:text-orange-500 dark:hover:text-violet-700/95 transition-colors duration-300" id="shop-link">--}}
{{--                Popular--}}
{{--            </a>--}}
{{--            <a href="/shop?sort=date" class="hover:text-orange-500 dark:hover:text-violet-700/95 transition-colors duration-300" id="shop-link">--}}
{{--                New--}}
{{--            </a>--}}
{{--            <a href="/shop?sort=price_low_to_high"--}}
{{--                class="hover:animate-pulse text-orange-500 dark:text-violet-600 transition-colors duration-300"--}}
{{--                id="shop-link">--}}
{{--                Sale--}}
{{--            </a>--}}
{{--            <a href="/games" class="hover:text-orange-500 dark:hover:text-violet-700/95 transition-colors duration-300">--}}
{{--                Games--}}
{{--            </a>--}}
{{--            <a href="/keyosk-plus"--}}
{{--                class="hover:text-orange-500 dark:hover:text-red-700/95 transition-colors duration-300">--}}
{{--                Keyosk+--}}
{{--            </a>--}}
        </div>
    </div>

    <div class="w-fit transition hover:scale-110">
        <x-navbar.logo-link />
    </div>

    <div>
        <div
            class="flex flex-row justify-end md:justify-between lg:justify-between items-center space-x-0.5 md:space-x-5 lg:space-x-3 min-w-[274px]">
            <x-navbar.games-icon />
            <x-navbar.cart-menu />
            <x-navbar.account-menu />
            {{-- Mobile Hamburger Menu --}}
            <x-navbar.hamburger-menu />
        </div>
    </div>
</nav>
