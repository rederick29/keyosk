{{--
    User profile register page.

    Author(s): Suktirath Bains: Front-end Developer, Erick Vilcica: Back-end Developer, intns: Back-end Developer
--}}
<x-layouts.min-layout>
    <div class="flex flex-col items-center justify-center space-y-10 h-screen w-dvh bg-gradient-to-tr from-orange-500 to-red-500 dark:from-violet-500 dark:to-pink-500 overscroll-contain">
        <div class="bg-white dark:bg-zinc-900 xs:w-2/3 md:w-2/3 lg:w-2/3 xl:w-2/3 2xl:w-2/3 xl:h-2/3 2xl:h-2/3 lg:h-2/3 md:h-2/3 sm:h-2/3 xs:h-2/3 sm:w-2/3 p-10 justify-self-center justify-center rounded-2xl overflow-y-auto">
            <div class="w-full flex flex-row items-center justify-center">
                <x-util.logo type="a" href="/" width=300 />
            </div>
            <form method="POST" action="{{ route('register.store') }}" class="flex flex-col 2xl:grid 2xl:grid-flow-row 2xl:grid-cols-2 xl:grid xl:grid-flow-row xl:grid-cols-2 md:grid md:grid-flow-row md:grid-cols-2 gap-4 space-y-4 text-center p-10 h-fit">
                @csrf
                <div class="flex flex-col space-y-2 h-1/12 lg:h-1/12 md:h-1/12 sm:h-1/12 xs:h-1/12 xl:h-1/12 2xl:h-1/12">
                    <x-auth.form.label for="name">Name</x-auth.form.label>
                    <x-auth.form.input id="name" name="name" required value="{{ old('name') }}" />
                    <x-auth.form.error name="name" />
                </div>
                <div class="flex flex-col space-y-2 h-1/12 lg:h-1/12 md:h-1/12 sm:h-1/12 xs:h-1/12 xl:h-1/12 2xl:h-1/12">
                    <x-auth.form.label for="name">Name</x-auth.form.label>
                    <x-auth.form.input id="name" name="name" required value="{{ old('name') }}" />
                    <x-auth.form.error name="name" />
                </div>
                
                <div class="flex flex-col space-y-2 h-1/12 lg:h-1/12 md:h-1/12 sm:h-1/12 xs:h-1/12 xl:h-1/12 2xl:h-1/12">
                    <x-auth.form.label for="email">Email Address</x-auth.form.label>
                    <x-auth.form.input type="email" id="email" name="email" required value="{{ old('email') }}" />
                    <x-auth.form.error name="email" />
                </div>
                <div class="flex flex-col space-y-2 h-1/12 lg:h-1/12 md:h-1/12 sm:h-1/12 xs:h-1/12 xl:h-1/12 2xl:h-1/12">
                    <x-auth.form.label for="password">Password</x-auth.form.label>
                    <x-auth.form.input type="password" id="password" name="password" required />
                    <x-auth.form.error name="password" />
                </div>
                <div class="flex flex-col space-y-2 h-1/12 lg:h-1/12 md:h-1/12 sm:h-1/12 xs:h-1/12 xl:h-1/12 2xl:h-1/12">
                    <x-auth.form.label for="password_confirmation">Confirm Password</x-auth.form.label>
                    <x-auth.form.input type="password" id="password_confirmation" name="password_confirmation" required />
                    <x-auth.form.error name="password_confirmation" />
                </div>
                <div class="flex flex-row items-center justify-between mt-6 lg:h-3/4 md:h-3/4 sm:h-3/4 xs:h-3/4">
                    <a class="w-fit hover:underline text-black/50 dark:text-white/50" href="{{ route('login.get') }}">
                        Already have an account?
                    </a>
                </div>
                <div class="flex flex-row items-center justify-center 2xl:justify-self-end xl:justify-self-end md:justify-self-end mt-6 lg:h-3/4 md:h-3/4 sm:h-3/4 xs:h-3/4">
                    <button type="submit" class="rounded-md bg-orange-500 dark:bg-violet-700 text-zinc-800 dark:text-white py-2 px-6 font-semibold hover:bg-orange-600 dark:hover:bg-violet-600 transition-all duration-500 mt-7">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.min-layout>