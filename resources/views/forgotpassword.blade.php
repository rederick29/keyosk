{{--
    User profile login page.

    Author(s): Mohammed Mousa: Front-end Developer
--}}
<x-layouts.min-layout>
    <div class="flex flex-col items-center justify-center space-y-10 h-screen w-full bg-gradient-to-tr from-orange-500 to-red-500 dark:from-violet-500 dark:to-pink-500">
        <div class="h-fit w-11/12 md:w-3/4 lg:w-1/3 p-10 flex flex-col justify-center rounded-2xl bg-stone-100 dark:bg-zinc-900">
            <div class="w-full flex flex-row items-center justify-center">
                <x-util.logo type="a" href="/" width=400 />
            </div>
            <form method="POST" action="/forgotpassword" class="flex flex-col text-center">
                @csrf
                <div class= "flex flex-col pt-5 text-xl">
                    <x-auth.form.label for="resetpassword">Reset Password</x-auth.form.label>
                </div>
                <p class= "flex flex-col pt-1 pb-4 text-left pl-1 font-medium text-black/50 dark:text-white/50">To reset password please enter you email address below</p>
                <div class= "flex flex-col space-y-2 text-lg">
                    <x-auth.form.label for="emailaddress">Email</x-auth.form.label>
                    <x-auth.form.input id="emailaddress" name="emailaddress" required/>
                    <x-auth.form.error name="emailaddress"/>
                </div>
                <div class="w-full flex flex-row items-center justify-end mt-3 space-x-5">
                    <button type="submit" class="w-32 h-12 font-semibold rounded-md bg-orange-500 dark:bg-violet-700 text-zinc-800 dark:text-white hover:bg-orange-600 dark:hover:bg-violet-600 transition-all duration-500">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.min-layout>