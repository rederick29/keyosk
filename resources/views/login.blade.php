
{{--
    User profile login page.

    Author(s): Suktirath Bains: Front-end Developer
--}}
<x-layouts.min-layout>
    <div class="flex flex-col items-center justify-center space-y-10 h-screen w-full bg-gradient-to-tr from-violet-500 to-pink-500">
        <x-util.logo class="text-zinc-800" type="a" href="/" width=400 />

        <div class="bg-zinc-900 w-1/3 justify-self-center justify-center h-fit rounded-2xl">
            <form action="/" class="flex flex-col space-y-8 text-center p-10">
                <div class="flex flex-col space-y-2">
                    <label for="username" class="font-semibold self-start ml-1">Username</label>
                    <input type="text" id="username" name="username" required class="h-14 p-3 text-xl rounded-lg bg-zinc-800 w-full ring-2 focus:outline-none">
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="username" class="font-semibold self-start ml-1">Password</label>
                    <input type="password" id="password" required class="h-14 p-3 rounded-lg text-xl bg-zinc-800 w-full ring-2 focus:outline-none">
                </div>
                <!--
                <div class="flex flex-row items-center space-x-2 ml-1">
                    <input type="checkbox" id="remember" value="" class="remember-me">
                    <label for="remember" class="font-semibold self-start ml-1">Remember Me</label>
                </div>
                -->
                <div class="w-full flex flew-row items-center justify-end mt-3 space-x-5">
                    <a class="underline" href="/">Forgot Your Password?</a>
                    <button type="submit" class="rounded-md bg-violet-700  text-white py-3 px-10 w-fit font-semibold hover:bg-violet-500">Log In</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.min-layout>
