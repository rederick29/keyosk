@props(['rating'])
<div id="ratingContainer" class="flex space-x-1">
    @php
    use App\Utils\ReviewStarState;
    $filled_stars = intdiv($rating, 2);
    $grey_stars = intdiv(10 - $rating, 2);
    $half_star = 5 - ($filled_stars + $grey_stars) != 0;
    @endphp
    @for($i = 0; $i < $filled_stars; $i++)
        <x-products.review-star state="{{ ReviewStarState::Filled }}"/>
    @endfor
    @if($half_star)
        <x-products.review-star state="{{ ReviewStarState::Half }}"/>
    @endif
    @for($i = 0; $i < $grey_stars; $i++)
        <x-products.review-star state="{{ ReviewStarState::Empty }}"/>
    @endfor
    {{ $slot }}
</div>
