{{--
    User profile register page.

    Author(s): Suktirath Bains: Front-end Developer, Erick Vilcica: Back-end Developer, intns: Back-end Developer
--}}
<x-layouts.min-layout>
    <div class="flex flex-col items-center justify-center space-y-10 h-screen w-dvh bg-gradient-to-tr from-orange-500 to-red-500 dark:from-violet-500 dark:to-pink-500 overscroll-contain">
        <div class="bg-white dark:bg-zinc-900 xs:w-2/3 md:w-2/3 lg:w-2/3 xl:w-2/3 2xl:w-2/3 p-10 justify-self-center justify-center rounded-2xl overflow-y-auto">
            <div class="w-full flex flex-row items-center justify-center">
                <x-util.logo type="a" href="/" width=300 />
            </div>
            <form method="POST" action="{{ route('register.store') }}" class="flex flex-col 2xl:grid 2xl:grid-flow-row 2xl:grid-cols-2 xl:grid xl:grid-flow-row xl:grid-cols-2 md:grid md:grid-flow-row md:grid-cols-2 gap-4 space-y-4 text-center p-10 h-fit">
                @csrf
                <div class="flex flex-col space-y-2 h-1/12 lg:h-1/12 md:h-1/12 sm:h-1/12 xs:h-1/12 xl:h-1/12 2xl:h-1/12">
                    <x-util.form.label for="first_name">First Name</x-util.form.label>
                    <x-util.form.input id="first_name" name="first_name" required value="{{ old('first_name') }}" />
                    <x-util.form.error name="first_name" />
                </div>
                <div class="flex flex-col space-y-2 h-1/12 lg:h-1/12 md:h-1/12 sm:h-1/12 xs:h-1/12 xl:h-1/12 2xl:h-1/12">
                    <x-util.form.label for="last_name">Last Name</x-util.form.label>
                    <x-util.form.input id="last_name" name="last_name" required value="{{ old('last_name') }}" />
                    <x-util.form.error name="last_name" />
                </div>
                
                <div class="flex flex-col space-y-2 h-1/12 col-span-2">
                    <x-util.form.label for="email">Email Address</x-util.form.label>
                    <x-util.form.input type="email" id="email" name="email" required value="{{ old('email') }}" />
                    <x-util.form.error name="email" />
                </div>
                <div class="flex flex-col space-y-2 h-1/12 ">
                    <x-util.form.label for="password">Password</x-auth.form.label>
                    <x-util.form.input type="password" id="password" name="password" required />
                    <x-util.form.error name="password" />
                </div>
                <div class="flex flex-col space-y-2 h-1/12">
                    <x-util.form.label for="password_confirmation">Confirm Password</x-auth.form.label>
                    <x-util.form.input type="password" id="password_confirmation" name="password_confirmation" required />
                    <x-util.form.error name="password_confirmation" />
                </div>
                <div class="flex flex-row items-center justify-between mt-6 h-3/4">
                    <a class="w-fit hover:underline text-black/50 dark:text-white/50" href="{{ route('login.get') }}">
                        Already have an account?
                    </a>
                </div>
                <div class="flex flex-row items-center justify-center 2xl:justify-self-end xl:justify-self-end md:justify-self-end mt-6 h-3/4">
                    <button type="submit" class="rounded-md bg-orange-500 dark:bg-violet-700 text-zinc-800 dark:text-white py-2 px-6 font-semibold hover:bg-orange-600 dark:hover:bg-violet-600 transition-all duration-500 mt-7">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.min-layout>