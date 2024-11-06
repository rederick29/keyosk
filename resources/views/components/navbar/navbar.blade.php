
{{--
    Navbar component, to be displayed at the top of all views (besides admin)

    Author(s): Ben Snaith : Main developer
               Arun (intns) : Implemented cryptographic nonce protection

    TODO: change the size of the icons on mobile
    TODO: Fix stupid animation pop in
--}}

<nav class="flex flex-row fixed justify-between items-center px-5 md:px-10 lg:px-20 min-h-24 min-w-full bg-zinc-900 text-neutral-400 border border-x-0 border-t-0 border-b-4 border-violet-700 shadow-xl">
    {{-- Desktop Links --}}
    <div class="hidden lg:block md:block">
        <div class="hidden md:flex lg:flex lg:flex-row md:flex-row items-center space-x-10 font-medium">
            <a href="" class="hover:text-indigo-700/95 transition-colors duration-300" id="shop-link">Shop</a>
            <a href="/contact" class="hover:text-indigo-700/95 transition-colors duration-300" >Contact</a>
            <a href="/about" class="hover:text-indigo-700/95 transition-colors duration-300" >About</a>
        </div>
    </div>

    <div class="w-fit">
       <x-navbar.logo-link />
    </div>

    <div>
        <div class="flex flex-row items-center space-x-0.5 lg:space-x-3 md:space-x-3">
            <x-navbar.search-menu />
            <x-navbar.cart-menu />
            <x-navbar.account-menu />
            {{-- Mobile Hamburger Menu --}}
            <x-navbar.hamburger-menu />
        </div>
    </div>
</nav>
