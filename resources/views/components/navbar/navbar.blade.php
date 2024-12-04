
{{--
    Navbar component, to be displayed at the top of all views (besides admin)

    Author(s): Ben Snaith : Main developer
               Arun (intns) : Implemented cryptographic nonce protection

    TODO: change the size of the icons on mobile
    TODO: Fix stupid animation pop in
--}}

<nav class="flex flex-row fixed justify-between items-center px-5 md:px-10 lg:px-20 min-h-24 min-w-full bg-zinc-900 border border-x-0 border-t-0 border-b-4 border-violet-700 shadow-xl z-50">
    {{-- Desktop Links --}}
    <div class="hidden lg:block md:block min-w-[184px]">
        <div class="hidden md:flex lg:flex lg:flex-row md:flex-row items-center space-x-10 font-medium">
            <a href="/" class="hover:text-indigo-700/95 transition-colors duration-300" id="shop-link">
                Shop
            </a>
        <a href="/" class="hover:text-indigo-700/95 transition-colors duration-300" id="shop-link">
                Popular
            </a>
            <a href="/" class="hover:text-indigo-700/95 transition-colors duration-300" id="shop-link">
                New
            </a>
            <a href="/" class="hover:text-indigo-700/95 transition-colors duration-300" id="shop-link">
                Sale
            </a>
        </div>
    </div>

    <div class="w-fit">
       <x-navbar.logo-link />
    </div>

    <div>
        <div class="flex flex-row justify-end md:justify-between lg:justify-between items-center space-x-0.5 md:space-x-5 lg:space-x-3 min-w-[274px]">
{{--            <div>--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/><circle cx="12" cy="10" r="3"/></svg>--}}
{{--            </div>--}}
            <x-navbar.search-menu />
            <x-navbar.cart-menu />
            <x-navbar.account-menu />
            {{-- Mobile Hamburger Menu --}}
            <x-navbar.hamburger-menu />
        </div>
    </div>
</nav>
