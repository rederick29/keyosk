<x-layouts.account-layout userId="2" :currentPage="'Wishlist'">
    <section class="w-full bg-white dark:bg-zinc-950">
        @php
            $user = Auth::user();
            $wishlist = $user->wishlist;
        @endphp
        <div class="flex flex-col">
            @forelse(Auth::user()->wishlist->products() as $product)
                <p>{{ $product }}</p>
            @empty
                <p class="text-zinc-800 dark:text-white">Your wishlist is empty.</p>
            @endforelse
        </div>
    </section>
</x-layouts.account-layout>
