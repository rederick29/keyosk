{{--
    User profile register page.

    Author(s): Suktirath Bains: Front-end Developer, Erick Vilcica: Back-end Developer, intns: Back-end Developer
--}}
<x-layouts.min-layout>
    <div class="flex flex-col   items-center justify-center space-y-10 h-screen w-full bg-gradient-to-tr from-violet-500 to-pink-500">
        <div class="bg-zinc-900 overflow-hidden overflow-y-auto w-11/12 xs-w-2/3 md:w-2/3 lg:w-2/3 lg:h-3/4 md:h-3/4 sm:h-3/4 xs:h-3/4 sm:w-2/3 p-10 justify-self-center justify-center h-fit rounded-2xl">
            <div class="w-full flex flex-row items-center justify-center">
                <x-util.logo type="a" href="/" width=300 />
            </div>
            <form method="POST" action="{{ route('register.store') }}" class="flex flex-col space-y-8 text-center p-10 h-fit">
                @csrf
                <div class="flex flex-col space-y-2 lg:h-1/2 md:h-1/2 sm:h-1/2 xs:h-1/2">
                    <x-auth.form.label for="name">Name</x-auth.form.label>
                    <x-auth.form.input id="name" name="name" required value="{{ old('name') }}" />
                    <x-auth.form.error name="name" />
                </div>
                <div class="flex flex-col space-y-2 lg:h-3/4 md:h-3/4 sm:h-3/4 xs:h-3/4">
                    <x-auth.form.label for="email">Email Address</x-auth.form.label>
                    <x-auth.form.input type="email" id="email" name="email" required value="{{ old('email') }}" />
                    <x-auth.form.error name="email" />
                </div>
                <div class="flex flex-col space-y-2 lg:h-3/4 md:h-3/4 sm:h-3/4 xs:h-3/4">
                    <x-auth.form.label for="password">Password</x-auth.form.label>
                    <x-auth.form.input type="password" id="password" name="password" required />
                    <x-auth.form.error name="password" />
                </div>
                <div class="flex flex-col space-y-2 lg:h-3/4 md:h-3/4 sm:h-3/4 xs:h-3/4">
                    <x-auth.form.label for="password_confirmation">Confirm Password</x-auth.form.label>
                    <x-auth.form.input type="password" id="password_confirmation" name="password_confirmation" required />
                    <x-auth.form.error name="password_confirmation" />
                </div>
                <div class="flex flex-row items-center justify-between mt-4 lg:h-3/4 md:h-3/4 sm:h-3/4 xs:h-3/4">
                    <a class="underline text-sm text-violet-400 hover:text-violet-300" href="{{ route('login.get') }}">
                        Already have an account?
                    </a>
                    <button type="submit" class="rounded-md bg-violet-700 text-white py-2 px-6 font-semibold hover:bg-violet-500">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.min-layout>