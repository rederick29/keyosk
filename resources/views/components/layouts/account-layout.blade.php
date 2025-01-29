<x-layouts.layout>
    <x-slot:title>Keyosk | Account</x-slot:title>

    <section
        class="w-full h-fit pt-32 flex flex-col items-center"
    >
        <div
            class="flex flex-row gap-x-5"
        >
            <x-util.button
                type="a"
                href="/account"
                class="w-96 hover:ring-4 ring-violet-700 font-semibold transition-shadow duration-500"
            >
                Account
            </x-util.button>
            <x-util.button
                type="a"
                href="/orders"
                class="w-96 bg-zinc-800 hover:ring-4 ring-violet-700 font-semibold transition-shadow duration-500"
            >
                Orders
                @if(Request::is('*orders*'))

                @endif
            </x-util.button>
        </div>
        <div
            class="w-full h-fit px-10 py-3"
        >
            {{ $slot }}
        </div>
    </section>
</x-layouts.layout>
