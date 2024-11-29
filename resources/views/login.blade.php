
{{--
    User profile login page.

    Author(s): Suktirath Bains: Front-end Developer, Erick Vilcica: Back-end Developer
--}}
<x-layouts.min-layout>
    <div class="flex flex-col items-center justify-center space-y-10 h-screen w-full bg-gradient-to-tr from-violet-500 to-pink-500">
        <x-util.logo class="text-zinc-800" type="a" href="/" width=400 />

        <div class="bg-zinc-900 w-1/3 justify-self-center justify-center h-fit rounded-2xl">
            <form method="POST" action="/login" class="flex flex-col space-y-8 text-center p-10">
                @csrf
                <div class="flex flex-col space-y-2">
                    <x-auth.form.label for="email">Email</x-auth.form.label>
                    <x-auth.form.input id="email" name="email" required/>
                    <x-auth.form.error name="email"/>
                </div>
                <div class="flex flex-col space-y-2">
                    <x-auth.form.label for="password">Password</x-auth.form.label>
                    <x-auth.form.input type="password" id="password" name="password" required/>
                    <x-auth.form.error name="password"/>
                </div>
                <!--
                <div class="flex flex-row items-center space-x-2 ml-1">
                    <input type="checkbox" id="remember" value="" class="remember-me">
                    <label for="remember" class="font-semibold self-start ml-1">Remember Me</label>
                </div>
                -->
                <div class="flex flex-row items-center justify-between mt-4">
                    <a class="underline text-sm text-violet-400 hover:text-violet-300" href="/">
                        Forgot Your Password?
                    </a>
                    <button type="submit" class="rounded-md bg-violet-700 text-white py-2 px-6 font-semibold hover:bg-violet-500">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.min-layout>
