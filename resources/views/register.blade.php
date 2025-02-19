{{--
    User profile register page.

    Author(s): Suktirath Bains: Front-end Developer, Erick Vilcica: Back-end Developer, intns: Back-end Developer
--}}
<x-layouts.min-layout>
    <div class="flex flex-col   items-center justify-center space-y-10 h-screen w-full bg-gradient-to-tr from-orange-500 to-red-500 dark:from-violet-500 dark:to-pink-500">
        <div class="bg-stone-100 dark:bg-zinc-900 overflow-hidden overflow-y-auto w-11/12 xs-w-2/3 md:w-2/3 lg:w-2/3 lg:h-3/4 md:h-3/4 sm:h-3/4 xs:h-3/4 sm:w-2/3 p-10 justify-self-center justify-center h-fit rounded-2xl">
            <div class="w-full flex flex-row items-center justify-center">
                <x-util.logo type="a" href="/" width=300 />
            </div>
            <form method="POST" action="{{ route('register.store') }}" class="flex flex-col space-y-8 text-center p-10 h-fit">
                @csrf
                <div class="flex flex-col space-y-2 lg:h-1/2 md:h-1/2 sm:h-1/2 xs:h-1/2">
                    <x-util.form.label for="first_name">First Name</x-util.form.label>
                    <x-util.form.input id="first_name" name="first_name" required value="{{ old('first_name') }}" />
                    <x-util.form.error name="first_name" />
                </div>
                <div class="flex flex-col space-y-2 lg:h-1/2 md:h-1/2 sm:h-1/2 xs:h-1/2">
                    <x-util.form.label for="last_name">Name</x-util.form.label>
                    <x-util.form.input id="last_name" name="last_name" required value="{{ old('last_name') }}" />
                    <x-util.form.error name="last_name" />
                </div>
                <div class="flex flex-col space-y-2 lg:h-3/4 md:h-3/4 sm:h-3/4 xs:h-3/4">
                    <x-util.form.label for="email">Email Address</x-util.form.label>
                    <x-util.form.input type="email" id="email" name="email" required value="{{ old('email') }}" />
                    <x-util.form.error name="email" />
                </div>
                <div class="flex flex-col space-y-2 lg:h-3/4 md:h-3/4 sm:h-3/4 xs:h-3/4">
                    <x-util.form.label for="password">Password</x-util.form.label>
                    <x-util.form.input type="password" id="password" name="password" required />
                    <x-util.form.error name="password" />
                </div>
                <div class="flex flex-col space-y-2 lg:h-3/4 md:h-3/4 sm:h-3/4 xs:h-3/4">
                    <x-util.form.label for="password_confirmation">Confirm Password</x-util.form.label>
                    <x-util.form.input type="password" id="password_confirmation" name="password_confirmation" required />
                    <x-util.form.error name="password_confirmation" />
                </div>
                <div class="flex flex-row items-center justify-between mt-4 lg:h-3/4 md:h-3/4 sm:h-3/4 xs:h-3/4">
                    <a class="w-fit hover:underline text-black/50 dark:text-white/50" href="{{ route('login.get') }}">
                        Already have an account?
                    </a>
                    <button type="submit" class="rounded-md bg-orange-500 dark:bg-violet-700 text-zinc-800 text-white py-2 px-6 font-semibold hover:bg-orange-600 dark:hover:bg-violet-600">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.min-layout>