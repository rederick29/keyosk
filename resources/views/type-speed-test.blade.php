<x-layouts.layout>
    <x-slot:title>Keyosk | Typing Speed Test</x-slot:title>
    <main class="min-h-screen flex flex-col items-center justify-center bg-white dark:bg-black text-black dark:text-white px-4 overflow-hidden relative">
        <h1 class="text-3xl font-bold mb-8 text-center relative z-10">Typing Speed Test</h1>

        <!-- Timer Selection -->
        <div class="mb-6 flex items-center gap-4 relative z-10">
            <label for="timer-select" class="text-lg font-semibold">Test Length:</label>
            <select id="timer-select" class="bg-zinc-200 dark:bg-zinc-900 text-black dark:text-white border border-gray-400 dark:border-gray-600 px-4 py-2 rounded-md focus:ring focus:ring-gray-500 dark:focus:ring-violet-500 transition">
                <option value="15">15s</option>
                <option value="30" selected>30s</option>
                <option value="60">60s</option>
                <option value="120">2 min</option>
            </select>
        </div>

        <!-- Stats Boxes -->
        <div class="flex flex-wrap justify-center gap-6 mb-6 relative z-10">
            <div class="stat-box bg-zinc-100 dark:bg-zinc-900 border border-gray-300 dark:border-gray-700 shadow-md">
                <p class="stat-value text-black dark:text-white" id="timer-display">30</p>
                <p class="stat-label text-black dark:text-white">Timer</p>
            </div>
            <div class="stat-box bg-zinc-100 dark:bg-zinc-900 border border-gray-300 dark:border-gray-700 shadow-md">
                <p class="stat-value text-black dark:text-white" id="wpm-display">0</p>
                <p class="stat-label text-black dark:text-white">WPM</p>
            </div>
            <div class="stat-box bg-zinc-100 dark:bg-zinc-900 border border-gray-300 dark:border-gray-700 shadow-md">
                <p class="stat-value text-black dark:text-white" id="accuracy-display">100%</p>
                <p class="stat-label text-black dark:text-white">Accuracy</p>
            </div>
            <div class="stat-box bg-zinc-100 dark:bg-zinc-900 border border-gray-300 dark:border-gray-700 shadow-md">
                <p class="stat-value text-black dark:text-white" id="word-count">0</p>
                <p class="stat-label text-black dark:text-white">Words</p>
            </div>
        </div>

        <!-- Test Container -->
        <div id="test-container" class="w-full flex flex-col items-center">
            <!-- Word Display & Typing Area -->
            <div class="w-[90%] max-w-[800px] h-[150px] bg-zinc-100 dark:bg-zinc-900 rounded-xl shadow-md mb-6 p-6 relative overflow-hidden">
                <div id="word-container" 
                class="w-full h-full text-2xl leading-snug text-black dark:text-white overflow-auto relative outline-none flex flex-wrap content-start" 
                tabindex="0">
                </div>

                <!-- Caret element -->
                <div id="caret" class="absolute w-0.5 bg-orange-500 dark:bg-violet-500 opacity-0 transition-opacity"></div>

                <!-- Start text overlay -->
                <p id="start-text" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-black dark:text-gray-400 text-lg pointer-events-none">
                    Click here or start typing to begin
                </p>
            </div>

            <div class="mt-4 relative z-10"> 
                <button id="restart-button" 
                    class="hidden ring-2 ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 
                        px-5 py-2 rounded-md font-semibold transition duration-300
                        hover:bg-orange-500 dark:hover:bg-violet-700
                        hover:text-white dark:hover:text-black">
                    Restart Test
                </button>
            </div>
        </div>

        <!-- Results Container -->
        <div id="results-container" class="w-full flex flex-col items-center hidden">
            <!-- Results Section -->
            <div id="results-section" class="hidden w-[90%] max-w-[800px] mt-8 bg-zinc-100 dark:bg-zinc-900 rounded-xl shadow-md p-6 relative z-10">
                <h2 class="text-2xl font-bold mb-4 text-black dark:text-white">Test Results</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-2 text-black dark:text-white">Performance</h3>
                        <ul class="space-y-2">
                            <li class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">WPM:</span>
                                <span id="result-wpm" class="font-medium text-black dark:text-white">0</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Raw WPM:</span>
                                <span id="result-raw-wpm" class="font-medium text-black dark:text-white">0</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Accuracy:</span>
                                <span id="result-accuracy" class="font-medium text-black dark:text-white">0%</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2 text-black dark:text-white">Details</h3>
                        <ul class="space-y-2">
                            <li class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Characters:</span>
                                <span id="result-characters" class="font-medium text-black dark:text-white">0</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Correct Words:</span>
                                <span id="result-correct-words" class="font-medium text-black dark:text-white">0</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Incorrect Words:</span>
                                <span id="result-incorrect-words" class="font-medium text-black dark:text-white">0</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Performance Graphs -->
                <div class="mt-8 grid grid-cols-3 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-2 text-black dark:text-white">WPM Performance</h3>
                        <canvas id="wpm-graph" width="300" height="200" class="w-full border border-gray-300 dark:border-gray-700 rounded"></canvas>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2 text-black dark:text-white">Accuracy</h3>
                        <canvas id="accuracy-graph" width="300" height="200" class="w-full border border-gray-300 dark:border-gray-700 rounded"></canvas>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2 text-black dark:text-white">Word Accuracy</h3>
                        <canvas id="word-distribution" width="300" height="200" class="w-full border border-gray-300 dark:border-gray-700 rounded"></canvas>
                    </div>
                </div>


                <div class="flex justify-center mt-6">
                    <button id="share-results-button" 
                        class="ring-2 ring-gray-500 dark:ring-gray-400 text-gray-600 dark:text-gray-400
                            px-5 py-2 rounded-md font-semibold transition duration-300 mx-2
                            hover:bg-gray-500 dark:hover:bg-gray-400
                            hover:text-white dark:hover:text-black">
                        Share Results
                    </button>

                    <button id="new-test-button" 
                        class="ring-2 ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 
                            px-5 py-2 rounded-md font-semibold transition duration-300 mx-2
                            hover:bg-orange-500 dark:hover:bg-violet-700
                            hover:text-white dark:hover:text-black">
                        New Test
                    </button>
                </div>
            </div>
        </div>

    </main>

    @vite('resources/ts/type-test.ts')
</x-layouts.layout>