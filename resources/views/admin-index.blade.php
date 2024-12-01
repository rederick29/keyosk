{{--
    Admin Homepage

    Author(s): intns : Main Developer
--}}

<x-layouts.layout>
    <x-slot:title>Admin Home</x-slot:title>
    <main class="h-screen bg-gradient-to-tr from-violet-500 to-pink-500 w-full">
        <div class="lg:pt-40 lg:px-80 ">
            <div class="bg-zinc-800 rounded-2xl p-6 shadow-2xl">
                <div class="mx-auto max-w-2xl text-center py-10">
                    <h2 class="text-balance text-4xl tracking-tight text-white lg:text-5xl">Admin Homepage</h2>
                </div>

                <div class="flex flex-col space-y-4 mb-6">
                    <div class="flex items-center space-x-4">
                        <!-- Search Bar -->
                        <input type="text" id="searchInput" placeholder="Search users..."
                            class="flex-[7] p-3 rounded-xl bg-gray-700 text-gray-300 border-2 border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out placeholder-gray-500 box-border" />

                        <!-- Search Button -->
                        <button id="searchButton"
                            class="flex-[1] p-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition duration-300 ease-in-out box-border">
                            Search
                        </button>
                    </div>
                </div>

                <div class="flex mb-6 justify-between">
                    <div class="flex-[1]">
                        <!-- All Users Dropdown -->
                        <select id="searchQuery"
                            class="flex-[2] p-2 rounded-xl bg-gray-800 text-gray-300 border-2 border-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out placeholder-gray-500 box-border">
                            <option value="">All Users</option>
                            <option value="admin_only">Admins Only</option>
                            <option value="users_only">Users Only</option>
                        </select>

                        <button id="select-all"
                            class="flex-[2] p-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition duration-300 ease-in-out box-border ml-4">
                            Select All
                    </button>
                    </div>

                    <div class="flex-[0.4]">
                        <div class="flex space-x-4 max-w-xl w-full justify-end">
                            <!-- Bulk Action Dropdown -->
                            <select id="bulkActionOpt" aria-label="Bulk Action"
                                class="flex-[2] p-2 rounded-xl bg-gray-800 text-gray-300 border-2 border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out placeholder-gray-500 box-border">
                                <option value="">Select Action</option>
                                <option value="delete">Delete User</option>
                                <option value="toggle_admin">Toggle User Admin</option>
                            </select>

                            <!-- Apply Button -->
                            <button id="apply-mod"
                                class="flex-[2] p-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition duration-300 ease-in-out box-border">
                                Apply
                            </button>
                        </div>
                    </div>
                </div>



                <hr>

                <div
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-h-[500px] overflow-y-auto p-4">
                    @foreach ($users as $user)
                        <div class="user-card group {{ $user->is_admin ? 'admin-user' : '' }}"
                            data-user-id="{{ $user->id }}" data-is-admin="{{ $user->is_admin ? 'true' : 'false' }}">

                            <!-- Wrap card content in a label -->
                            <label for="checkbox-{{ $user->id }}"
                                class="relative bg-white rounded-2xl p-5 shadow-md hover:shadow-xl hover:bg-gray-100 transition-all duration-300 ease-in-out transform hover:-translate-y-1 overflow-hidden flex flex-col justify-between cursor-pointer"
                                style="aspect-ratio: 3.5 / 1;">

                                <!-- Checkbox (visually still in the corner) -->
                                <input type="checkbox" id="checkbox-{{ $user->id }}" value="{{ $user->id }}"
                                    class="user-select-checkbox absolute top-4 right-4 h-5 w-5 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-2 focus:ring-blue-500">

                                <!-- Card Content -->
                                <div>
                                    <div class="user-name text-lg font-semibold text-gray-800 mb-2">
                                        {{ $user->name }} ({{ $user->email }})
                                        @if ($user->is_admin)
                                            <span
                                                class="ml-2 text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full absolute bottom-4 right-4 text-right">Admin

                                                @if ($user->id === auth()->id())
                                                    <span class="text-red-500"> (You)</span>
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        <script nonce="{{ session('csp_nonce') }}">
            document.addEventListener('DOMContentLoaded', () => {
                // Cache DOM Elements
                const searchInput = document.getElementById('searchInput');
                const searchButton = document.getElementById('searchButton');
                const searchQuery = document.getElementById('searchQuery');
                const checkboxes = document.querySelectorAll('.user-select-checkbox');
                const bulkActionOpt = document.getElementById('bulkActionOpt');
                const applyModButton = document.getElementById('apply-mod');

                // Load saved search parameters
                const savedSearch = localStorage.getItem('search') || '';
                let savedQuery = localStorage.getItem('query') || '';

                // Stop trying to hack/fuzz our website, you're already an admin, you turd
                if (savedQuery !== 'admin_only' && savedQuery !== 'users_only') {
                    savedQuery = '';
                }

                // Set initial search inputs
                searchInput.value = savedSearch;
                searchQuery.value = savedQuery;

                // Attach event listeners
                attachEventListeners();

                function attachEventListeners() {
                    searchButton.addEventListener('click', performSearch);
                    searchInput.addEventListener('keypress', handleEnterKey);
                    searchInput.addEventListener('input', debounce(performSearch, 500));
                    searchQuery.addEventListener('change', performSearch);
                    applyModButton.addEventListener('click', applyBulkAction);
                }

                function handleEnterKey(e) {
                    if (e.key === 'Enter') performSearch();
                }

                function performSearch() {
                    const searchTerm = searchInput.value.trim();
                    const selectedQuery = searchQuery.value;
                    const params = new URLSearchParams();

                    if (searchTerm) params.set('search', searchTerm);
                    if (selectedQuery) params.set('query', selectedQuery);

                    // Save search terms for future use
                    localStorage.setItem('search', searchTerm);
                    localStorage.setItem('query', selectedQuery);

                    window.location.href = `?${params.toString()}`;
                }

                function applyBulkAction() {
                    const selectedIds = getSelectedIds();
                    const bulkAction = bulkActionOpt.value;

                    // Check if any users are selected
                    if (selectedIds.length === 0) {
                        toastr.error('No users selected!');
                        return;
                    }

                    // Check if an action is selected
                    if (!bulkAction) {
                        toastr.error('No action selected!');
                        return;
                    }

                    // Confirm the bulk action
                    if (!confirm('Are you sure you want to continue?')) {
                        return;
                    }

                    // Perform the bulk action
                    switch (bulkAction) {
                        case 'delete':
                            deleteUsers(selectedIds);
                            break;
                        case 'toggle_admin':
                            toggleAdminStatus(selectedIds);
                            break;
                        default:
                            toastr.error('Invalid action selected! (how did you even do that?)');
                            break;
                    }
                }

                function getSelectedIds() {
                    return Array.from(checkboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);
                }

                function deleteUsers(ids) {
                    sendBulkActionRequest('delete', ids)
                        .then(response => {
                            if (response.ok) {
                                window.location.reload();
                            } else {
                                handleError(response);
                            }
                        });
                }

                function toggleAdminStatus(ids) {
                    sendBulkActionRequest('toggle_admin', ids)
                        .then(response => {
                            if (response.ok) {
                                window.location.reload();
                            } else {
                                handleError(response);
                            }
                        });
                }

                function sendBulkActionRequest(action, ids) {
                    return fetch('/admin/users/bulk-action', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            action,
                            user_ids: ids
                        })
                    });
                }

                function handleError(response) {
                    response.json().then(data => {
                        toastr.error('Error: ' + data.message);
                    }).catch(error => {
                        toastr.error('Error: ' + response.statusText);
                    });
                }

                // Debounce function to limit the frequency of the search
                function debounce(func, wait) {
                    let timeout;
                    return (...args) => {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => func(...args), wait);
                    };
                }
            });
        </script>

    </main>
</x-layouts.layout>
