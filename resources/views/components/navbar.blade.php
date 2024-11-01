
{{--
    Example navbar for now, this will be replaced
    when suki has finished his navbar implementation.
    Inspiration taken from suki's design.

    This is extremely basic, due to the lack of routing
    and views, all links point to index.
--}}

<nav class="flex flex-row justify-between items-center lg:min-h-[12vh] min-w-full bg-zinc-800 text-white border border-x-0 border-t-0 border-b-4 border-violet-700 shadow-xl fixed">
    <div class="mx-64">
        <a href="/">LOGO</a>
    </div>

    <div class="mx-20">
        <a href="/" class="mx-6">Shop</a>
        <a href="/" class="mx-6">Contact</a>
        <a href="/" class="mx-6 mr-10">About</a>
        <x-searchbar />
    </div>
</nav>
