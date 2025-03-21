
{{--
    User profile login page.

    Author(s): Suktirath Bains: Front-end Developer, Erick Vilcica: Back-end Developer
--}}
<x-layouts.min-layout>
    <div class="flex flex-col items-center justify-center space-y-10 h-screen w-full bg-linear-to-tr from-orange-500 to-red-500 dark:from-violet-500 dark:to-pink-500">

        <div class="h-fit w-11/12 md:w-3/4 lg:w-1/3 p-10 flex flex-col justify-center rounded-2xl bg-stone-100 dark:bg-zinc-900">
            <div class="w-full flex flex-row items-center justify-center">
                <x-util.logo type="a" href="/" width=300 />
            </div>
            <form method="POST" action="/login" class="flex flex-col space-y-8 text-center">
                @csrf
                <div class="flex flex-col space-y-2">
                    <x-util.form.label for="email">Email</x-util.form.label>
                    <x-util.form.input id="email" name="email" required/>
                    <x-util.form.error name="email"/>
                </div>
                <div class="flex flex-col space-y-2">
                    <div class="w-full flex flex-row justify-between">
                        <x-util.form.label for="password">Password</x-util.form.label>
                        <span><a class="w-fit hover:underline text-black/50 dark:text-white/50" href="/forgot">Forgot Your Password?</a></span>
                    </div>
                    <x-util.form.input type="password" id="password" name="password" required/>
                    <x-util.form.error name="password"/>
                </div>
                <!--
                <div class="flex flex-row items-center space-x-2 ml-1">
                    <input type="checkbox" id="remember" value="" class="remember-me">
                    <label for="remember" class="font-semibold self-start ml-1">Remember Me</label>
                </div>
                -->
                <div class="w-full flex flex-row items-center justify-end mt-3 space-x-5">
                    <!-- Not sure where this should link as for now -->
                    <a class="w-[126px] h-[46px] flex items-center justify-center rounded-md bg-transparent ring-2 font-semibold ring-orange-500 dark:ring-violet-700 text-orange-500 dark:text-violet-700 hover:bg-orange-500 dark:hover:bg-violet-700 hover:text-zinc-800 dark:hover:text-white transition-all duration-500" href="/register">
                        Register
                    </a>
                    <button type="submit" class="w-32 h-12 font-semibold rounded-md bg-orange-500 dark:bg-violet-700 text-zinc-800 dark:text-white hover:bg-orange-600 dark:hover:bg-violet-600 transition-all duration-500">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.min-layout>
