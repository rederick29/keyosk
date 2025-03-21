<x-layouts.layout>
    <x-slot:title>Keyosk | Click Speed Test</x-slot:title>
    <main class="min-h-screen flex flex-col items-center justify-center bg-white dark:bg-black text-black dark:text-white px-4 overflow-hidden relative">
        <h1 class="text-4xl font-bold mb-6 text-center relative z-10">Click Speed Test</h1>

        <!-- Timer Selection -->
        <div class="mb-6 flex items-center gap-4 relative z-10">
            <label for="timer-select" class="text-lg font-semibold">Select Time:</label>
            <select id="timer-select" class="bg-zinc-200 dark:bg-zinc-900 text-black dark:text-white border border-gray-400 dark:border-gray-600 px-4 py-2 rounded-md focus:ring focus:ring-gray-500 dark:focus:ring-violet-500 transition">
                <option value="10">10s</option>
                <option value="30">30s</option>
                <option value="60">1 min</option>
            </select>
        </div>

        <!-- Stats Boxes -->
        <div class="flex flex-wrap justify-center gap-6 mb-6 relative z-10">
            <div class="stat-box bg-zinc-100 dark:bg-zinc-900 border border-gray-300 dark:border-gray-700 shadow-md">
                <p class="stat-value text-black dark:text-white" id="timer-display">10</p>
                <p class="stat-label text-black dark:text-white">Timer</p>
            </div>
            <div class="stat-box bg-zinc-100 dark:bg-zinc-900 border border-gray-300 dark:border-gray-700 shadow-md">
                <p class="stat-value text-black dark:text-white" id="cps-display">0</p>
                <p class="stat-label text-black dark:text-white">Click/s</p>
            </div>
            <div class="stat-box bg-zinc-100 dark:bg-zinc-900 border border-gray-300 dark:border-gray-700 shadow-md">
                <p class="stat-value text-black dark:text-white" id="click-count">0</p>
                <p class="stat-label text-black dark:text-white">Total Clicks</p>
            </div>
        </div>

        <!-- Clickable Box -->
        <div id="click-area" class="w-[70%] max-w-[500px] h-[250px] bg-zinc-200 dark:bg-black border-4 border-gray-400 dark:border-gray-700 rounded-xl shadow-lg flex items-center justify-center cursor-pointer relative overflow-hidden hover:shadow-lg transition-all">
            <p id="start-text" class="text-lg text-black dark:text-gray-400">Click here to start</p>
        </div>

        <div class="mt-12 relative z-10"> 
            <button id="restart-button" 
                class="hidden ring-2 ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 
                    px-5 py-2 rounded-md font-semibold transition duration-300
                    hover:bg-orange-500 dark:hover:bg-violet-700
                    hover:text-white dark:hover:text-black">
                Restart Test
            </button>
        </div>


    </main>

    @vite('resources/ts/click-test.ts')
</x-layouts.layout>