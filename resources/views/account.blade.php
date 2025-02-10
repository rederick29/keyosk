<x-layouts.account-layout :userId="$user->id" :currentPage="'Account'">
    <section class="">

        <div class="ml-2">
        <h1
            class="text-3xl font-semibold"
        >
            Account
        </h1>
        <p class="pb-5">View and edit your Keyosk account</p>
        </div>

        <hr class="border-zinc-800 border-1" />

        <!-- Full Name -->

        <form class="w-full pl-2 py-5 gap-y-5 flex flex-col">
            <div>
                <p class="font-semibold">Full name</p>
                <p class="dark:text-white/50">View or edit contact name</p>
            </div>
            @csrf
            <div class="flex gap-x-5">
                <div class="flex flex-col space-y-2 w-1/2">
                    <x-auth.form.label
                        for="current-password"
                        class="ml-0"
                    >
                        First name
                    </x-auth.form.label>
                    <x-auth.form.input
                        id="current-password"
                        name="current-password"
                        class=""
                        required
                    />
                    <x-auth.form.error
                        name="current-password"
                    />
                </div>
                <div class="flex flex-col space-y-2 w-1/2">
                    <x-auth.form.label
                        for="new-password"
                        class="ml-0"
                    >
                        Last name
                    </x-auth.form.label>
                    <x-auth.form.input
                        type="new-password"
                        id="new-password"
                        name="new-password"
                        required
                    />
                    <x-auth.form.error
                        name="new-password"
                    />
                </div>
            </div>
        </form>

        <hr class="border-zinc-800 border-1" />

        <!-- Contact Email -->

        <form class="w-full pl-2 py-5 flex flex-col gap-y-5">
            <div>
                <p class="font-semibold">Contact Email</p>
                <p class="dark:text-white/50">View or edit contact email</p>
            </div>
            @csrf
            <div class="flex gap-x-5">
                <div class="flex flex-col space-y-2 w-1/2">
                    <x-auth.form.label
                        for="current-password"
                        class="ml-0"
                    >
                        Email
                    </x-auth.form.label>
                    <x-auth.form.input
                        id="current-password"
                        name="current-password"
                        class=""
                        required
                    />
                    <x-auth.form.error
                        name="current-password"
                    />
                </div>
            </div>
        </form>

        <hr class="border-zinc-800 border-1" />

        <!-- Password -->

        <form class="w-full pl-2 py-5 gap-y-5 flex flex-col">
            <div>
                <p class="font-semibold">Password</p>
                <p class="dark:text-white/50">Modify the current account password</p>
            </div>
            @csrf
            <div class="flex gap-x-5">
                <div class="flex flex-col space-y-2 w-1/2">
                    <x-auth.form.label
                        for="current-password"
                        class="ml-0"
                    >
                        Current Password
                    </x-auth.form.label>
                    <x-auth.form.input
                        id="current-password"
                        name="current-password"
                        class=""
                        required
                    />
                    <x-auth.form.error
                        name="current-password"
                    />
                </div>
                <div class="flex flex-col space-y-2 w-1/2">
                    <x-auth.form.label
                        for="new-password"
                        class="ml-0"
                    >
                        New Password
                    </x-auth.form.label>
                    <x-auth.form.input
                        type="new-password"
                        id="new-password"
                        name="new-password"
                        required
                    />
                    <x-auth.form.error
                        name="new-password"
                    />
                </div>
            </div>
        </form>

        <hr class="border-zinc-800 border-1" />

        <!-- Account Security -->

        <form class="w-full pl-2 py-5 gap-y-5 flex flex-col">
            <div>
                <p class="font-semibold">Account Security</p>
                <p class="dark:text-white/50">Manage account security</p>
            </div>
            @csrf
            <div class="flex gap-x-5">

            </div>
        </form>
    </section>
</x-layouts.account-layout>
