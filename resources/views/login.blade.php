
{{--
    User profile login page.

    Author(s): Suktirath Bains: Front-end Developer, Erick Vilcica: Back-end Developer
--}}
<x-layouts.min-layout>
    <div class="flex flex-col items-center justify-center space-y-10 h-screen w-full bg-gradient-to-tr from-violet-500 to-pink-500">

        <div class="h-fit w-11/12 md:w-3/4 lg:w-1/3 p-10 flex flex-col justify-center rounded-2xl bg-zinc-900">
            <div class="w-full flex flex-row items-center justify-center">
                <x-util.logo type="a" href="/" width=300 />
            </div>
            <form method="POST" action="/login" class="flex flex-col space-y-8 text-center">
                @csrf
                <div class="flex flex-col space-y-2">
                    <x-auth.form.label for="email">Email</x-auth.form.label>
                    <x-auth.form.input id="email" name="email" required/>
                    <x-auth.form.error name="email"/>
                </div>
                <div class="flex flex-col space-y-2">
                    <div class="w-full flex flex-row justify-between">
                        <x-auth.form.label for="password">Password</x-auth.form.label>
                        <!-- Not sure where this should link as for now -->
                        <span><a class="w-fit hover:underline text-white/50" href="/">Forgot Your Password?</a></span>
                    </div>
                    <x-auth.form.input type="password" id="password" name="password" required/>
                    <x-auth.form.error name="password"/>
                </div>
                <!--
                <div class="flex flex-row items-center space-x-2 ml-1">
                    <input type="checkbox" id="remember" value="" class="remember-me">
                    <label for="remember" class="font-semibold self-start ml-1">Remember Me</label>
                </div>
                -->
                <div class="w-full flex flex-row items-center justify-end mt-3 space-x-5">
                    <!-- Not sure where this should link as for now -->
                    <a class="underline" href="/">
                        Register
                    </a>
                    <button type="submit" class="rounded-md bg-violet-700 text-white py-3 px-10 font-semibold hover:bg-violet-600">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.min-layout>
