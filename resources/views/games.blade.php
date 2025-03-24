{{--
    Games Page

    Author(s): intns
--}}

<x-layouts.layout>
    <x-slot:title>Keyosk | Games</x-slot:title>

    <div class="bg-white dark:bg-zinc-950 pt-32 pb-16 text-zinc-800 dark:text-white">
        <div class="container mx-auto px-4 md:px-8">
            <div class="text-center mb-16 anim-up">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-orange-500 dark:text-violet-600">
                    Test Your Skills
                </h1>
                <div class="w-24 h-1 bg-orange-500 dark:bg-violet-700 mx-auto mb-6"></div>
                <p class="text-xl md:text-2xl max-w-3xl mx-auto text-zinc-700 dark:text-zinc-300">
                    Put your new Keyosk peripherals to the test with these interactive games
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
                <div class="game-card bg-stone-100 dark:bg-zinc-900 rounded-xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                    <div class="h-48 bg-gradient-to-r from-orange-400 to-orange-600 dark:from-violet-700 dark:to-purple-900 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-2 text-orange-500 dark:text-violet-500">Click Test</h3>
                        <p class="text-zinc-700 dark:text-zinc-300 mb-4">
                            How fast can you click? Challenge yourself and see if you can beat our record. Perfect for testing your new mouse!
                        </p>
                        <div class="flex justify-center">
                            <a href="/games/click-test" class="inline-block px-6 py-3 bg-orange-500 dark:bg-violet-700 text-white font-semibold rounded-lg hover:bg-orange-600 dark:hover:bg-violet-800 transition-colors duration-300">
                                Start Clicking
                            </a>
                        </div>
                    </div>
                </div>

                <div class="game-card bg-stone-100 dark:bg-zinc-900 rounded-xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                    <div class="h-48 bg-gradient-to-r from-orange-400 to-orange-600 dark:from-violet-700 dark:to-purple-900 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-2 text-orange-500 dark:text-violet-500">Typing Test</h3>
                        <p class="text-zinc-700 dark:text-zinc-300 mb-4">
                            Test your typing speed and accuracy with our challenging typing test. The true measure of a gamer's keyboard skills!
                        </p>
                        <div class="flex justify-center">
                            <a href="/games/type-test" class="inline-block px-6 py-3 bg-orange-500 dark:bg-violet-700 text-white font-semibold rounded-lg hover:bg-orange-600 dark:hover:bg-violet-800 transition-colors duration-300">
                                Start Typing
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-16 text-center">
                <h2 class="text-2xl font-bold mb-4 text-orange-500 dark:text-violet-600">More Games Coming Soon</h2>
                <p class="text-zinc-700 dark:text-zinc-300 max-w-2xl mx-auto">
                    We're constantly developing new ways for you to test and enjoy your Keyosk peripherals.
                    Check back regularly for new additions to our games collection!
                </p>
            </div>
        </div>
    </div>
</x-layouts.layout>
