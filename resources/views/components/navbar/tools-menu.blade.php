{{-- Tools Menu Component --}}
<div class="relative">
    <!-- Gear Icon (for opening dropdown) -->
    <div class="flex flex-row items-center justify-center p-2 rounded-lg ring-orange-500 dark:ring-violet-700 
        hover:bg-black/5 dark:hover:bg-white/5 transition-colors duration-300 cursor-pointer" id="tools-icon">
        
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="3"/>
            <path d="M19.4 15a2 2 0 0 1 0 4l-1.8.6a2 2 0 0 0-1.2 1.2L15 21.4a2 2 0 0 1-4 0l-.6-1.8a2 2 0 0 0-1.2-1.2L7 19.4a2 2 0 0 1 0-4l1.8-.6a2 2 0 0 0 1.2-1.2L9 14a2 2 0 0 1 4 0l.6 1.8a2 2 0 0 0 1.2 1.2L19.4 15z"/>
        </svg>

        <div class="hidden lg:inline md:inline">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 9l6 6 6-6"/>
            </svg>
        </div>
    </div>

    {{-- Tools Dropdown Menu --}}
    <div id="tools-dropdown" 
        class="scale-0 border-2 border-neutral-400 bg-white dark:bg-zinc-900 rounded fixed md:absolute lg:absolute 
        md:rounded-lg lg:rounded-lg shadow-2xl w-[100vw] md:w-72 lg:w-72 h-fit top-24 right-0 md:top-12 lg:top-12 
        md:right-0 lg:right-0">
        
        <div class="flex flex-col items-center space-y-2 min-h-[100%] m-4">
            <a href="/ClickSpeedTest" class="w-full text-center py-2 font-semibold hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                Click Speed Test
            </a>
            <a href="/TypeSpeedTest" class="w-full text-center py-2 font-semibold hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                Type Speed Test
            </a>
            <a href="/3d-game" class="w-full text-center py-2 font-semibold hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                3D Game
            </a>
        </div>
    </div>
</div>
