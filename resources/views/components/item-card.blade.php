{{--
    Index page of website.

    Author(s): Ben Snaith : Main Developer
--}}

<x-layouts.layout>
    {{-- Ability to slot in a title to the layout for modularity --}}
    {{-- <x-slot:title>Example Title</x-slot:title> --}}
    <main class="h-screen">
        <x-util.imagescroll></x-util.imagescroll>

        <div class="flex flex-row">
        <x-util.item-card />
        <x-util.item-card />
        <x-util.item-card />
        <x-util.item-card />
        </div>

    </main>
</x-layouts.layout>