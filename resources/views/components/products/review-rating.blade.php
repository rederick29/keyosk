@props(['rating'])
<div id="ratingContainer" class="flex space-x-1">
    @php
        // The review-star component calculates based on the returned star states
        use App\Utils\ReviewStarState;
        $starStates = ReviewStarState::calculateStarStates($rating);
    @endphp

    @foreach ($starStates as $state)
        <x-products.review-star :state="$state" />
    @endforeach

    {{ $slot }}
</div>
