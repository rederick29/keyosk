
{{--
    Example navbar for now, this will be replaced
    when suki has finished his navbar implementation.
    Inspiration taken from suki's design.

    This is extremely basic, due to the lack of routing
    and views, all links point to index.

    TODO: make more responsive, spacing properties need changing
--}}

<nav class="flex flex-row justify-between items-center lg:min-h-[12vh] min-w-full bg-black text-white border border-x-0 border-t-0 border-b-4 border-violet-700 shadow-xl fixed">
    <div class="lg:px-64">
        <a href="/">LOGO</a>
    </div>

    <div class="lg:space-x-20 lg:px-20 font-medium">
        <a href="/" class="hover:text-white/80 transition-colors duration-300" id="shop-link">Shop</a>
        <a href="/" class="hover:text-white/80 transition-colors duration-300" >Contact</a>
        <a href="/" class="hover:text-white/80 transition-colors duration-300" >About</a>
        <x-searchbar />
    </div>
</nav>
