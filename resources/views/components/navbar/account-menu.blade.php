
{{--
    Account menu component to appear in navbar

    Author(s): Ben Snaith : Main Developer

    TODO: fix dropdown animation
--}}

<div class="relative">
    <div class="flex flex-row items-center justify-center p-2 rounded-lg ring-orange-500 dark:ring-violet-700 hover:bg-black/5 dark:hover:bg-white/5 transition-colors duration-300" id="account-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        <div class="arrow transition duration-300 hidden lg:inline md:inline">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </div>
    </div>
    {{-- Drop down menu --}}
    {{-- Desktop and Medium View --}}
    <div class="scale-0 border-2 border-neutral-400 bg-white dark:bg-zinc-900 rounded-sm fixed md:absolute lg:absolute md:rounded-lg lg:rounded-lg shadow-2xl w-[100vw] md:w-72 lg:w-72 h-fit top-24 right-0 md:top-12 lg:top-12 md:right-0 lg:right-0" id="account-dropdown">
        <div class="flex flex-col items-center space-y-1 min-h-[100%] m-4">
            @auth
                <section class="w-full h-fit space-y-2 font-normal text-center">
                    <p class="py-0 my-0 font-semibold">Welcome,
                        <span class="{{ Auth::user()->subscription ? Auth::user()->subscription->getTierGradient() . " bg-linear-to-r text-transparent bg-clip-text" : "" }}">
                            {{ Str::title(Auth::user()->name) }}
                        </span>
                    </p>
                    <p class="pt-0 pb-1 text-sm">Keyosk coins: {{ Auth::user()->coins }} </p>
                    <hr class="border-2 rounded-xl border-stone-200 dark:border-zinc-700" />
                    <x-util.button  type="a" href="{{ route('account.get') }}">
                        My Account
                    </x-util.button>
                    <x-util.button  type="a" href="{{ route('orders.get') }}">
                        Orders
                    </x-util.button>
                    <x-util.button  type="a" href="/wishlist">
                        Wishlist
                    </x-util.button>

                    <!-- Admin Buttons -->
                    @if(Auth::user()->is_admin)
                        <hr class="border-2 rounded-xl border-stone-200 dark:border-zinc-700" />
                        <x-util.button  type="a" href="{{ route('stats') }}" class="bg-linear-to-bl from-orange-500 to-red-500 dark:from-violet-500 dark:to-pink-500 hover:to-red-600 hover:from-orange-600 dark:hover:from-violet-600 dark:hover:to-pink-600 text-white overflow-hidden [&>span]:translate-x-4 hover:[&>span]:translate-x-0 [&>svg]:translate-y-10 hover:[&>svg]:translate-y-0 [&>*]:transition">
                            <span>Admin Dashboard</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                        </x-util.button>
                        <hr class="border-2 rounded-xl border-stone-200 dark:border-zinc-700" />
                    @endif

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" name="logout" class="dropdown-link bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 text-white font-semibold overflow-hidden [&>span]:translate-x-4 hover:[&>span]:translate-x-0 [&>svg]:translate-y-10 hover:[&>svg]:translate-y-0 [&>*]:transition">
                            <span>Log Out</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 3H6a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h4M16 17l5-5-5-5M19.8 12H9"/></svg>
                        </button>
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

