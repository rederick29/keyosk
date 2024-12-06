
{{--
    Account menu component to appear in navbar

    Author(s): Ben Snaith : Main Developer

    TODO: fix dropdown animation
--}}

<div class="relative">
    <div class="flex flex-row items-center justify-center p-2 rounded-lg ring-violet-700 hover:bg-white/5 transition-colors duration-300" id="account-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        <div class="hidden lg:inline md:inline">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </div>
    </div>
    {{-- Drop down menu --}}
    {{-- Desktop and Medium View --}}
    <div class="dropdown-hide w-[100vw] md:w-72 lg:w-72 h-fit top-24 right-0 md:top-12 lg:top-12 md:right-0 lg:right-0" id="account-dropdown">
        <div class="flex flex-col items-center space-y-1 min-h-[100%] m-4">
            <x-util.button  type="a" href="/" class="">
                My Account
            </x-util.button>
            <x-util.button  type="a" href="/" class="">
                My Orders
            </x-util.button>
            <x-util.button  type="a" href="/" class="">
                Settings
            </x-util.button>

            <div class="h-16"></div>
            @auth
                <section class="w-full h-fit space-y-3 font-bold text-center">
                    <p>Welcome, {{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" name="logout" class="dropdown-link bg-red-700 hover:bg-red-800 text-white">Log Out</button>
                    </form>
                </section>
            @endauth
            @guest
                <x-util.button  type="a" href="/login" class="">
                    Log in
                </x-util.button>
                <x-util.button  type="a" href="/register" class="">
                    Register
                </x-util.button>
            @endguest
        </div>
    </div>
</div>

