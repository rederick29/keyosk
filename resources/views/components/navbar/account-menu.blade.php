<div class="flex flex-row items-center justify-center p-2 rounded-md transition-colors duration-300 relative" id="account-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
    <div class="hidden lg:inline md:inline">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
    </div>
    {{-- Drop down menu --}}
    <div class="dropdown-hide-desktop" id="account-dropdown">
        <div class="flex flex-col items-center space-y-1 min-h-[100%] m-2">
            <a href="/" class="dropdown-link">My Account</a>
            <a href="/" class="dropdown-link">My Orders</a>
            <a href="/" class="dropdown-link">Settings</a>
            <div class="grow h-5"></div>
            <a href="/" class="text-red-700 dropdown-link">Log out</a>
        </div>
    </div>
</div>

@once
    <script nonce="{{ session("csp_nonce") }}">
        let accountIcon = document.getElementById('account-icon');
        let accountDropdown = document.getElementById('account-dropdown');
        let accountDropdownToggle = false;

        accountIcon.addEventListener("click", function() {
            if(!accountDropdownToggle) {
                accountIcon.classList.add("bg-white/5", "shadow-inner")
                accountDropdown.classList.remove('dropdown-hide-desktop');
                accountDropdown.classList.add('dropdown-display-desktop');
                accountDropdownToggle = true;
            }
            else {
                accountIcon.classList.remove("bg-white/5", "shadow-inner")
                accountDropdown.classList.remove('dropdown-display-desktop');
                accountDropdown.classList.add('dropdown-hide-desktop');
                accountDropdownToggle = false;
            }
        });
    </script>
@endonce
