<x-layouts.layout>
    <x-slot:title>Keyosk | Account</x-slot:title>
    <div class="w-full pt-52 h-full flex flex-col p-2">
        <h3>User: {{ $user->name }}</h3>
        <h3>Email: {{ $user->email }}</h3>
        <h3>Admin: {{ $user->is_admin ? "true" : "false" }}</h3>
    </div>
</x-layouts.layout>
