<x-layouts.account-layout :userId="$user->id" :currentPage="'Reviews'">
    <section class="w-full bg-white dark:bg-zinc-950">
        @foreach($allReviews as $review)
            <div>
                <x-review.review-card :review="$review"></x-review.review-card>
            </div>
        @endforeach
    </section>
</x-layouts.account-layout>
