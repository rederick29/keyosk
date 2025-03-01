@props(['review'])
<div class={{ $attributes->merge(["class" => "border-t border-orange-500 dark:border-violet-700"]) }}>
    <p class="py-2 pt-4">{{ $review->user->name }}</p>
    <x-products.review-rating class="w-3 h-3" rating="{{ $review->rating }}">
        <p id="rating" class="text-white font-semibold">&emsp;{{ $review->subject }}</p>
    </x-products.review-rating>
    <p class="py-2 pb-4">{{ $review->comment }}</p>
</div>
