
{{--
    User profile login page.

    Author(s): Suktirath Bains: Front-end Developer
--}}
<body>
<x-layouts.layout>
    <div class="bg-zinc-900 pt-12 w-96 justify-self-center  justify-center mx-auto h-50 rounded-3xl mb-6 ">
        <div class="ml-16"><x-util.logo class="ml" type="a" href="/" width=250 /></div>
        <p class="text-white text-center text-md mt-10 mb-50">Login to Keyosk</p>
        <form action="" class="mx-auto text-center px-10 py-10 lg:py-15 lg:px-8 border-solid border-violet-700">
            <input type="text" id="username" name="username" placeholder="Email/Username" required class="p-2 mb-5 rounded mt_10 bg-zinc-700 w-2/3">
            <input type="text" id="username" placeholder="Password" required class="p-2 mb-10 rounded bg-zinc-700 w-2/3">
            <button type="login" class="rounded-md bg-violet-700 hover:bg-violet-500  text-white px-5 py-3 w-1/2  font-semibold">Log-in</button>
        </form>
    </div> 

</x-layouts.layout>