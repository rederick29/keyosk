
{{--
    Account menu component to appear in navbar

    Author(s): Ben Snaith : Main Developer

    TODO: fix dropdown animation
--}}

<div class="flex flex-row items-center justify-center p-2 rounded-md ring-violet-700 hover:bg-white/5 transition-colors duration-300 relative" id="account-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
    <div class="hidden lg:inline md:inline">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
    </div>
    {{-- Drop down menu --}}
    <div class="dropdown-hide-desktop w-52 h-fit top-12 right-0" id="account-dropdown">
        <div class="flex flex-col items-center space-y-1 min-h-[100%] m-2">
            <a href="/" class="dropdown-link">My Account</a>
            <a href="/" class="dropdown-link">My Orders</a>
            <a href="/" class="dropdown-link">Settings</a>
            <div class="grow h-5"></div>
            <a href="/" class="dropdown-link hover:bg-red-600/50 text-white bg-red-600">Log out</a>
        </div>
    </div>
</div>

