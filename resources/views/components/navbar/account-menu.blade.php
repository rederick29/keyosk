
{{--
    Account menu component to appear in navbar

    Author(s): Ben Snaith : Main Developer

    TODO: fix dropdown animation
--}}

<div class="relative">
    <div class="flex flex-row items-center justify-center p-2 rounded-lg ring-orange-500 dark:ring-violet-700 hover:bg-black/5 dark:hover:bg-white/5 transition-colors duration-300" id="account-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        <div class="hidden lg:inline md:inline">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </div>
    </div>
    {{-- Drop down menu --}}
    {{-- Desktop and Medium View --}}
    <div class="scale-0 border-2 border-neutral-400 bg-white dark:bg-zinc-900 rounded fixed md:absolute lg:absolute md:rounded-lg lg:rounded-lg shadow-2xl w-[100vw] md:w-72 lg:w-72 h-fit top-24 right-0 md:top-12 lg:top-12 md:right-0 lg:right-0" id="account-dropdown">
        <div class="flex flex-col items-center space-y-1 min-h-[100%] m-4">
            @auth
            <section class="w-full h-fit space-y-2 font-normal text-center">
                    <p class="py-1 font-semibold">Welcome, {{ Str::title(\Illuminate\Support\Facades\Auth::user()->name) }}</p>
                    <hr class="border-2 rounded-xl border-stone-200 dark:border-zinc-700" />
                    <x-util.button  type="a" href="{{ route('account.get') }}">
                        My Account
                    </x-util.button>
                    <x-util.button  type="a" href="{{ route('orders.get') }}">
                        Orders
                    </x-util.button>
                    <x-util.button  type="a" href="/">
                        Wishlist
                    </x-util.button>

                    <!-- Admin Buttons -->
                    @if(Auth::user()->is_admin)
                        <hr class="border-2 rounded-xl border-stone-200 dark:border-zinc-700" />
                        <x-util.button  type="a" href="{{ route('manage-users') }}" class="bg-gradient-to-bl from-orange-500 to-red-500 dark:from-violet-500 dark:to-pink-500 hover:to-red-600 hover:from-orange-600 hover:dark:from-violet-700 hover:dark:to-pink-700 text-white">
                            Admin Dashboard
                        </x-util.button>
                        <hr class="border-2 rounded-xl border-stone-200 dark:border-zinc-700" />
                    @endif

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" name="logout" class="dropdown-link bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-800 text-white font-semibold">Log Out</button>
                    </form>
                </section>
            @endauth
            @guest
                <x-util.button  type="a" href="{{ route('login.get') }}" class="">
                    Log in
                </x-util.button>
                <x-util.button  type="a" href="{{ route('register.get') }}" class="">
                    Register
                </x-util.button>
            @endguest
        </div>
    </div>
</div>

