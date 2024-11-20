<!-- Author: Toms Xavi  -->


<div class="relative rounded-lg bg-zinc-900 shadow-lg w-80 h-80 max-w-full text-white overflow-hidden transition-transform transform hover:scale-105 mt-1 mb-4 mx-4">
    <div class="h-3/4 w-full"> 
        <img src="https://picsum.photos/80" alt="Top Image" class="w-full h-full object-cover rounded-t-lg">
    </div>

    <div class="h-1/4 w-full p-4 flex flex-col justify-center items-center bg-zinc-900 rounded-b-lg">
        <div class="text-center">
            <h3 class="text-lg font-semibold">Card Title</h3> 
            <p class="text-xs text-zinc-400 mt-2">Some description text.</p> 
        </div>
        <div class="mt-4">
            {{ $slot }}
        </div>
    </div>
</div>
