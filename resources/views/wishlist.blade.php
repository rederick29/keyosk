<x-layouts.account-layout :currentPage="'Wishlist'">
    <section class="w-full bg-white dark:bg-zinc-950">
        @php
            $user = Auth::user();
            $wishlist = $user->wishlist();
        @endphp
        <div class="flex flex-col">
            @forelse ($wishlist as $wishlistIten)
                <p>{{ $wishlistItem }}</p>
            @empty
                <p class="text-zinc-800 dark:text-white">Your wishlist is empty.</p>
            @endforelse
        </div>
    </section>
</x-layouts.account-layout>
