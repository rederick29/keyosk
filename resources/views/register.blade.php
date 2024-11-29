
{{--
    User profile register page.

    Author(s): Suktirath Bains: Front-end Developer, Erick Vilcica: Back-end Developer
--}}
<x-layouts.min-layout>
    <div class="flex flex-col items-center justify-center space-y-10 h-screen w-full bg-gradient-to-tr from-violet-500 to-pink-500">
        <x-util.logo class="text-zinc-800" type="a" href="/" width=400 />

        <div class="bg-zinc-900 w-1/3 justify-self-center justify-center h-fit rounded-2xl">
            <form method="POST" action="/register" class="flex flex-col space-y-8 text-center p-10">
                @csrf
                <div class="flex flex-col space-y-2">
                    <x-auth.form.label for="name">Name</x-auth.form.label>
                    <x-auth.form.input id="name" name="name" required/>
                    <x-auth.form.error name="name"/>
                </div>
                <div class="flex flex-col space-y-2">
                    <x-auth.form.label for="email">Email address</x-auth.form.label>
                    <x-auth.form.input type="email" id="email" name="email" required/>
                    <x-auth.form.error name="email"/>
                </div>
                <div class="flex flex-col space-y-2">
                    <x-auth.form.label for="password">Password</x-auth.form.label>
                    <x-auth.form.input type="password" id="password" name="password" required/>
                    <x-auth.form.error name="password"/>
                </div>
                <div class="flex flex-col space-y-2">
                    <x-auth.form.label for="password_confirmation">Confirm Password</x-auth.form.label>
                    <x-auth.form.input type="password" id="password_confirmation" name="password_confirmation" required/>
                    <x-auth.form.error name="password_confirmation"/>
                </div>
                <!--
                <div class="flex flex-row items-center space-x-2 ml-1">
                    <input type="checkbox" id="remember" value="" class="remember-me">
                    <label for="remember" class="font-semibold self-start ml-1">Remember Me</label>
                </div>
                -->
                <div class="w-full flex flew-row items-center justify-end mt-3 space-x-5">
                    <a class="underline" href="/login">Already have an account?</a>
                    <button type="submit" class="rounded-md bg-violet-700  text-white py-3 px-10 w-fit font-semibold hover:bg-violet-500">Register</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.min-layout>
