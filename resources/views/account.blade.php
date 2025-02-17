<x-layouts.account-layout :userId="$user->id" :currentPage="'Account'">
    <form action="{{ \Illuminate\Support\Facades\Auth::user()->is_admin ? route('account.edit.uid', ['userId' => $user->id]) : route('account.edit') }}" method="POST" class="">
        @csrf
        <div class="w-full justify-between flex px-2">
            <div class="flex-col">
                <h1
                    class="text-3xl font-semibold"
                >
                    Account
                </h1>
                <p class="pb-5">View and edit your Keyosk account</p>
            </div>
            <x-util.button type="button" class="w-1/6 h-1/2 self-center bg-orange-500 dark:bg-violet-700 text-white hover:bg-orange-600 dark:hover:bg-violet-800">Apply Changes</x-util.button>
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
                    <x-auth.form.label
                        for="first_name"
                        class="ml-0"
                    >
                        First name
                    </x-auth.form.label>
                    <x-auth.form.input
                        id="first_name"
                        name="first_name"
                        class=""
                        placeholder="{{$user->first_name}}"
                    />
                    <x-auth.form.error
                        name="first_name"
                    />
                </div>
                <div class="flex flex-col space-y-2 w-1/2">
                    <x-auth.form.label
                        for="last_name"
                        class="ml-0"
                    >
                        Last name
                    </x-auth.form.label>
                    <x-auth.form.input
                        id="last_name"
                        name="last_name"
                        placeholder="{{$user->last_name}}"
                    />
                    <x-auth.form.error
                        name="last_name"
                    />
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
                    <x-auth.form.label
                        for="email"
                        class="ml-0"
                    >
                        Email
                    </x-auth.form.label>
                    <x-auth.form.input
                        id="email"
                        name="email"
                        class=""
                        type="email"
                        placeholder="{{ $user->email }}"
                    />
                    <x-auth.form.error
                        name="email"
                    />
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
                    <x-auth.form.label
                        for="current_password"
                        class="ml-0"
                    >
                        Current Password
                    </x-auth.form.label>
                    <x-auth.form.input
                        id="current_password"
                        name="current_password"
                        type="password"
                        class=""
                    />
                    <x-auth.form.error
                        name="current_password"
                    />
                </div>
                <div class="flex flex-col space-y-2 w-1/2">
                    <x-auth.form.label
                        for="new_password"
                        class="ml-0"
                    >
                        New Password
                    </x-auth.form.label>
                    <x-auth.form.input
                        id="new_password"
                        name="new_password"
                        type="password"
                    />
                    <x-auth.form.error
                        name="new_password"
                    />
                </div>
            </div>
        </section>

        <hr class="border-zinc-800 border-1" />

        <!-- Account Security -->

        <section class="w-full px-2 py-5 gap-y-5 flex flex-col">
            <div>
                <p class="font-semibold">Account Security</p>
                <p class="dark:text-white/50">Manage account security</p>
            </div>
            <div class="flex gap-x-5">
                <x-util.button type="button" class="w-1/6  bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-800 text-white font-semibold">Delete Account</x-util.button>
                <x-util.button type="button" class="w-1/6  bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-800 text-white font-semibold">Log Out</x-util.button>
            </div>
        </section>
    </form>
</x-layouts.account-layout>
