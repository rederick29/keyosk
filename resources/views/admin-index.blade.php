{{--
    Index page of website.

    Author(s): Ben Snaith : Main Developer, intns (minor changes)
--}}

<x-layouts.layout>
    <x-slot:title>Admin Home</x-slot:title>
    <main class="h-screen bg-gradient-to-tr from-violet-500 to-pink-500 w-full">
        <div class="px-6 py-20 pt-35 lg:pt-40 lg:px-80 ">
            <div class="bg-zinc-800 rounded-2xl p-6 shadow-2xl">
                <div class="mx-auto max-w-2xl text-center py-20">
                    <h2 class="text-balance text-4xl tracking-tight text-white lg:text-5xl">Admin Homepage</h2>
                </div>

                <div class="flex flex-col space-y-4 mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="adminFilter"
                                class="h-5 w-5 text-blue-600 bg-gray-700 border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                            <label for="adminFilter" class="text-white text-sm font-medium">Admin Only</label>
                        </div>

                        <div class="flex-grow w-full flex items-center space-x-2">
                            <input type="text" id="searchInput" placeholder="Search users..."
                                class="w-full p-3 rounded-xl bg-gray-700 text-gray-300 border-2 border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out placeholder-gray-500" />
                            <button id="searchButton"
                                class="px-4 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition duration-300 ease-in-out">
                                Search
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-h-[500px] overflow-y-auto p-4">
                    @foreach ($users as $user)
                        <div class="user-card group {{ $user->is_admin ? 'admin-user' : '' }}"
                            data-is-admin="{{ $user->is_admin ? 'true' : 'false' }}">
                            <div
                                class="bg-white rounded-2xl p-5 shadow-md hover:shadow-xl hover:bg-gray-100 transition-all duration-300 ease-in-out transform hover:-translate-y-1 relative overflow-hidden">
                                <div class="user-name text-lg font-semibold text-gray-800 mb-2">
                                    {{ $user->name }}
                                    @if ($user->is_admin)
                                        <span
                                            class="ml-2 text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Admin</span>
                                    @endif
                                </div>
                                <div
                                    class="user-email opacity-0 group-hover:opacity-100 absolute inset-0 bg-black bg-opacity-70 text-white flex items-center justify-center transition-opacity duration-300 ease-in-out">
                                    <span class="text-sm">{{ $user->email }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        <script nonce="{{ session('csp_nonce') }}">
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const searchButton = document.getElementById('searchButton');
                const adminFilter = document.getElementById('adminFilter');

                let timeout;

                // Restore previous search and filter states
                const urlParams = new URLSearchParams(window.location.search);
                const savedSearch = urlParams.get('search') || '';
                const savedIsAdmin = urlParams.get('is_admin') === '1';

                searchInput.value = savedSearch;
                adminFilter.checked = savedIsAdmin;

                // Search on button click
                searchButton.addEventListener('click', performSearch);

                // Search on Enter key press
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        performSearch();
                    }
                });

                // Toggle admin filter
                adminFilter.addEventListener('change', function() {
                    performSearch();
                });

                // Debounced search function (searches after 0.5 second of inactivity)
                searchInput.addEventListener('input', function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(performSearch, 500);
                });

                function performSearch() {
                    const searchTerm = searchInput.value.trim();
                    const isAdminChecked = adminFilter.checked;

                    // Construct URL parameters
                    const params = new URLSearchParams();
                    if (searchTerm) {
                        params.set('search', searchTerm);
                    }
                    if (isAdminChecked) {
                        params.set('is_admin', '1');
                    }

                    // Redirect with parameters
                    window.location.href = `?${params.toString()}`;
                }
            });
        </script>
    </main>
</x-layouts.layout>
