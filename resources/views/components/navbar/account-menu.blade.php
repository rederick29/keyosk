
{{--
    Account menu component to appear in navbar

    Author(s): Ben Snaith : Main Developer

    TODO: fix dropdown animation
--}}

<div class="flex flex-row items-center justify-center p-2 rounded-lg ring-violet-700 hover:bg-white/5 transition-colors duration-300 relative" id="account-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
    <div class="hidden lg:inline md:inline">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
    </div>
    {{-- Drop down menu --}}
    {{-- Desktop and Medium View --}}
    <div class="dropdown-hide w-[100vw] md:w-72 lg:w-72 h-fit top-24 right-0 md:top-12 lg:top-12 md:right-0 lg:right-0" id="account-dropdown">
        <div class="flex flex-col items-center space-y-1 min-h-[100%] m-4">
            <x-navbar.dropdown-link type="a" href="/" class="">
                My Account
            </x-navbar.dropdown-link>
            <x-navbar.dropdown-link type="a" href="/" class="">
                My Orders
            </x-navbar.dropdown-link>
            <x-navbar.dropdown-link type="a" href="/" class="">
                Settings
            </x-navbar.dropdown-link>

            <div class="h-16"></div>

            <x-navbar.dropdown-link type="a" href="/" class="bg-red-600 hover:bg-red-700 text-white">Log Out</x-navbar.dropdown-link>
        </div>
    </div>
</div>

