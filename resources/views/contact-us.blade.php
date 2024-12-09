{{--
Contact us page to be used as a view on website.

Author(s): Kai Chima : Main Developer
Ben Snaith : Minor formatting and edits

TODO: implement search-bar relationship
--}}

<x-layouts.layout>
    <x-slot:title>Keyosk | Contact Us</x-slot:title>
    <div class="bg-stone-200 dark:bg-zinc-900 px-6 py-20 pt-35 lg:pt-40 lg:px-80">
        <div class="max-w-2xl text-center">
            <h2 class="text-4xl text-black/50 dark:text-gray-300 lg:text-5xl">Contact Us</h2>
            <p class="text-lg/8 mt-3 text-violet-700">Enter details below</p>
        </div>
        <form action="{{ route('contact.send') }}" method="POST" class="mx-auto mt-10 max-w-lg lg:mt-10">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-6 gap-y-5 ">
                <div>
                    <label for="first-name"
                        class="block font-semibold text-lg/6 text-black/50 dark:text-gray-300 text-sm">First name</label>
                    <div class="mt-2.5">
                        <input type="text" name="first-name" id="first-name"
                            class="block font-semibold w-full rounded-lg  px-3.5 py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                            required>
                    </div>
                </div>
                <div>
                    <label for="last-name"
                        class="block font-semibold text-lg/6 text-black/50 dark:text-gray-300 text-sm">Last name</label>
                    <div class="mt-2.5">
                        <input type="text" name="last-name" id="last-name"
                            class="block font-semibold w-full rounded-lg  px-3.5 py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                            required>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <label for="email"
                        class="block font-semibold text-lg/6 text-black/50 dark:text-gray-300 text-sm">Email</label>
                    <div class="mt-2.5">
                        <input type="email" name="email" id="email"
                            class="block font-semi bold w-full rounded-lg  px-3.5 py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700"
                            required>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <label for="subject"
                        class="block font-semibold  text-lg/6 text-black/50 dark:text-gray-300 text-sm">Subject</label>
                    <div class="mt-2.5">
                        <input type="text" name="subject" id="subject"
                            class="block font-semibold w-full rounded-lg  px-3.5 py-2 text-black/50 dark:text-gray-300 bg-zinc-300 dark:bg-zinc-700">
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <label for="message"
                        class="block font-semibold text-lg/6 text-black/50 dark:text-gray-300 text-sm">Message</label>
                    <div class="mt-2.5">
                        <textarea name="message" id="message" rows="4"
                            class="block font-semibold w-full rounded-lg px-3.5 py-2 text-black/50 dark:text-gray-300 placeholder:text-black/50 dark:text-gray-300-400 bg-zinc-300 dark:bg-zinc-700"
                            minlength="10" maxlength="250" required></textarea>
                    </div>
                </div>
            </div>
            <div class="mt-8">
                      <button type="submit" name="submit"
                    class="block w-full rounded-lg bg-orange-500 dark:bg-zinc-700 px-5 py-2 text-center text-base border border-orange-500  dark:border-violet-700 text-black dark:text-white font-semibold hover:bg-orange-600 dark:hover:bg-violet-800 hover:text-zinc-800 dark:hover:text-white transition duration-300"
                    onSubmit="msgSent()">Submit</button>
            </div>
        </form>
        <div id="sentPopup" class="hidden p-4 mt-1 mb-4 text-md text-green-400 rounded-md bg-gray-700">
            <p>Message sent!</p>
        </div>
        <script nonce={{ csp_nonce() }}>
            document.addEventListener('DOMContentLoaded', function() {
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}');
                @endforeach
            });

            function msgSent() {
                document.getElementById("sentPopup").classList.remove('hidden');
            }
        </script>
    </div>
</x-layouts.layout>
