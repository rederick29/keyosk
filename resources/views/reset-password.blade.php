{{--
    Reset password page.

    Author(s): intns
--}}
@props(['passwordToken'])
<x-layouts.min-layout>
    <div class="flex flex-col items-center justify-center space-y-10 h-screen w-full bg-linear-to-tr from-orange-500 to-red-500 dark:from-violet-500 dark:to-pink-500">

        <div class="h-fit w-11/12 md:w-3/4 lg:w-1/3 p-10 flex flex-col justify-center rounded-2xl bg-stone-100 dark:bg-zinc-900">
            <div class="w-full flex flex-row items-center justify-center">
                <x-util.logo type="a" href="{{ route('index') }}" width=300 />
            </div>


            <div class="my-4">
                <h2 class="text-xl font-semibold mb-2">Password Reset</h2>
                <p class="text-black/70 dark:text-white/70">Please type in your new password.</p>
            </div>

            <form method="POST" action="{{ route('password.reset.post') }}" class="flex flex-col space-y-8 text-center">
                @csrf
                <input type="hidden" name="token" id="token" value="{{ $passwordToken }}">
                <div class="flex flex-col space-y-2">
                    <x-util.form.label for="email">Email</x-util.form.label>
                    <x-util.form.input id="email" name="email" type="email" required autofocus/>
                    <x-util.form.error name="email"/>
                </div>
                <div class="flex flex-col space-y-2">
                    <x-util.form.label for="password">Password</x-util.form.label>
                    <x-util.form.input id="password" name="password" type="password" required autofocus/>
                    <x-util.form.error name="password"/>
                </div>
                <div class="flex flex-col space-y-2">
                    <x-util.form.label for="password_confirmation">Confirm Password</x-util.form.label>
                    <x-util.form.input id="password_confirmation" name="password_confirmation" type="password" required autofocus/>
                    <x-util.form.error name="password_confirmation"/>
                </div>

                <div class="w-full flex flex-row items-center justify-between mt-3 space-x-5">
                    <a class="w-[126px] h-[46px] flex items-center justify-center rounded-md bg-transparent ring-2 font-semibold ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 hover:bg-orange-500 dark:hover:bg-violet-700 hover:text-zinc-800 dark:hover:text-white transition-all duration-500" href="{{ route('login.get') }}">
                        Back to Login
                    </a>
                    <button type="submit" class="w-48 h-12 font-semibold rounded-md bg-orange-500 dark:bg-violet-700 text-zinc-800 dark:text-white hover:bg-orange-600 dark:hover:bg-violet-600 transition-all duration-500">
                        Reset password
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.min-layout>
