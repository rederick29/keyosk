<x-layouts.account-layout userId="2" :currentPage="'Wishlist'">
    <section class="w-full bg-white dark:bg-zinc-950">
        @php
            $user = Auth::user();
            $wishlist = $user->wishlist;
            if (!$wishlist) {
                $wishlist = \App\Models\Wishlist::factory()->forUser($user)->create();
            }
        @endphp
        <div class="flex flex-col">
            @vite('resources/ts/product-buttons.ts')
            @forelse($wishlist->products as $product)
                <x-util.product-card :product="$product" :_product="$product"></x-util.product-card>
            @empty
                <p class="text-zinc-800 dark:text-white">Your wishlist is empty.</p>
            @endforelse
        </div>
    </section>
</x-layouts.account-layout>
