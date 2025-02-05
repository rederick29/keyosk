<x-layouts.account-layout>
    <form class="w-full flex flex-col space-y-8 text-center">
        @csrf
        <div class="flex">
            <div class="flex flex-col space-y-2">
                <x-auth.form.label for="current-password">Current Password</x-auth.form.label>
                <x-auth.form.input id="current-password" name="current-password" required/>
                <x-auth.form.error name="current-password"/>
            </div>
            <div class="flex flex-col space-y-2">
                <x-auth.form.label for="new-password">New Password</x-auth.form.label>
                <x-auth.form.input type="new-password" id="new-password" name="new-password" required/>
                <x-auth.form.error name="new-password"/>
            </div>
        </div>
        <button type="submit" class="w-32 h-12 font-semibold rounded-md bg-orange-500 dark:bg-violet-700 text-zinc-800 dark:text-white hover:bg-orange-600 dark:hover:bg-violet-600 transition-all duration-500">
            Submit
        </button>
    </form>
</x-layouts.account-layout>
