
{{--
    Example navbar for now, this will be replaced
    when suki has finished his navbar implementation.
    Inspiration taken from suki's design.

    This is extremely basic, due to the lack of routing
    and views, all links point to index.

    TODO: make more responsive, spacing properties need changing
--}}

<nav class="flex flex-row fixed justify-between items-center px-5 md:px-10 lg:px-20 min-h-24 min-w-full bg-zinc-900 text-white border border-x-0 border-t-0 border-b-4 border-violet-700 shadow-xl">
    {{-- Desktop Links --}}
    <div class="hidden lg:block md:block">
        <div class="hidden md:flex lg:flex lg:flex-row md:flex-row items-center space-x-10 font-medium">
            <a href="/" class="hover:text-indigo-700/95 transition-colors duration-300" id="shop-link">Shop</a>
            <a href="/" class="hover:text-indigo-700/95 transition-colors duration-300" >Contact</a>
            <a href="/" class="hover:text-indigo-700/95 transition-colors duration-300" >About</a>
        </div>
    </div>

    <div>
        <a href="/">
            KEYTAMINE
        </a>
    </div>

    <div class="">
        <div class="flex flex-row items-center space-x-0.5 lg:space-x-3 md:space-x-3">
            <div class="flex flex-row items-center justify-center p-2 mr-0 md:mr-3 lg:mr-3 rounded-md hover:bg-white/5 transition-colors duration-300" id="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
            <div class="flex flex-row items-center justify-center p-2 font-semibold rounded-md hover:bg-white/5 transition-colors duration-300" id="cart-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="20.5" r="1"/><circle cx="18" cy="20.5" r="1"/><path d="M2.5 2.5h3l2.7 12.4a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.6l1.6-8.4H7.1"/></svg>
                <div class="hidden lg:inline md:inline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </div>
            </div>
            <div class="flex flex-row items-center justify-center p-2 rounded-md hover:bg-white/5 transition-colors duration-300" id="account-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <div class="hidden lg:inline md:inline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </div>
            </div>
            {{-- Mobile Hamburger Menu --}}
            <div class="lg:hidden md:hidden max-w-[40%]">
                <div class="flex flex-row lg:hidden md:hidden items-center space-x-0.5 p-2 rounded-md hover:bg-white/5 transition-colors duration-300" id="hamburger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Laravel is not a fan of imported js files so for now we are using the @once directive and then <script> with the code inside. --}}
    @once
        <script>
            let accountIcon = document.getElementById('account-icon');
            let cartIcon = document.getElementById('cart-icon');
            let searchIcon = document.getElementById('search-icon');
            let hamburger = document.getElementById('hamburger');

            accountIcon.addEventListener("click", function() {
                console.log("Account icon");
            });
            cartIcon.addEventListener("click", function() {
                console.log("Cart icon");
            });
            searchIcon.addEventListener("click", function() {
                console.log("Search icon");
            });
            hamburger.addEventListener("click", function() {
                console.log("Hamburger icon");
            });
        </script>
    @endonce
</nav>
