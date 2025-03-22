<x-layouts.account-layout :currentPage="'Account'" :userId="$user->id">
    <form
        action="{{ \Illuminate\Support\Facades\Auth::user()->is_admin ? route('account.edit.uid', ['userId' => $user->id]) : route('account.edit') }}"
        class="" method="POST">
        @csrf
        <div class="w-full justify-between flex px-2">
            <div class="flex-col">
                <h1 class="text-3xl font-semibold">
                    Account
                </h1>
                <p class="pb-5">View and edit your Keyosk account</p>
            </div>
            <x-util.button
                class="w-1/6 h-1/2 self-center bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800"
                type="button">Apply Changes</x-util.button>
        </div>

        <hr class="border-zinc-800 border-1" />

        <!-- Full Name -->

        <section class="w-full px-2 py-5 gap-y-5 flex flex-col">
            <div>
                <p class="font-semibold">Full name</p>
                <p class="dark:text-white/50">View or edit contact name</p>
            </div>
            <div class="flex gap-x-5">
                <div class="flex flex-col space-y-2 w-1/2">
                    <x-util.form.label class="ml-0" for="first_name">
                        First name
                    </x-util.form.label>
                    <x-util.form.input class="w-full" id="first_name" name="first_name"
                        placeholder="{{ $user->first_name }}" />
                    <x-util.form.error name="first_name" />
                </div>
                <div class="flex flex-col space-y-2 w-1/2">
                    <x-util.form.label class="ml-0" for="last_name">
                        Last name
                    </x-util.form.label>
                    <x-util.form.input class="w-full" id="last_name" name="last_name"
                        placeholder="{{ $user->last_name }}" />
                    <x-util.form.error name="last_name" />
                </div>
            </div>
        </section>

        <hr class="border-zinc-800 border-1" />

        <!-- Contact Email -->

        <section class="w-full px-2 py-5 flex flex-col gap-y-5">
            <div>
                <p class="font-semibold">Contact Email</p>
                <p class="dark:text-white/50">View or edit contact email</p>
            </div>
            <div class="flex gap-x-5">
                <div class="flex flex-col space-y-2 w-1/2">
                    <x-util.form.label class="ml-0" for="email">
                        Email
                    </x-util.form.label>
                    <x-util.form.input class="w-full" id="email" name="email" placeholder="{{ $user->email }}"
                        type="email" />
                    <x-util.form.error name="email" />
                </div>
            </div>
        </section>

        <hr class="border-zinc-800 border-1" />

        <!-- Password -->

        <section class="w-full px-2 py-5 gap-y-5 flex flex-col">
            <div>
                <p class="font-semibold">Password</p>
                <p class="dark:text-white/50">Modify the current account password</p>
            </div>
            <div class="flex gap-x-5">
                <div class="flex flex-col space-y-2 w-1/2">
                    <x-util.form.label class="ml-0" for="current_password">
                        Current Password
                    </x-util.form.label>
                    <x-util.form.input class="w-full" id="current_password" name="current_password" type="password" />
                    <x-util.form.error name="current_password" />
                </div>
                <div class="flex flex-col space-y-2 w-1/2">
                    <x-util.form.label class="ml-0" for="new_password">
                        New Password
                    </x-util.form.label>
                    <x-util.form.input class="w-full" id="new_password" name="new_password" type="password" />
                    <x-util.form.error name="new_password" />
                </div>
            </div>
        </section>

        <hr class="border-zinc-800 border-1" />
    </form>

    <!-- Account Security -->
    <section class="w-full px-2 py-5 gap-y-5 flex flex-col">
        <div>
            <p class="font-semibold">Account Security</p>
            <p class="dark:text-white/50">Manage account security</p>
        </div>
        <div class="flex gap-x-5">
            <form class="w-1/6" action="{{ Auth::user()->is_admin ? route('account.delete.uid', ['userId' => $user->id]) : route('account.delete') }}" method="POST"> @csrf
                <x-util.button
                    class="bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-800 text-white font-semibold"
                    type="button">Delete Account</x-util.button>
            </form>
            @if(Auth::id() === $user->id)
                <form class="w-1/6" action="{{ route('logout') }}"> @csrf
                    <x-util.button
                        class="bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-800 text-white font-semibold"
                        type="button">Log Out</x-util.button>
                </form>
            @endif
        </div>
    </section>
</x-layouts.account-layout>
