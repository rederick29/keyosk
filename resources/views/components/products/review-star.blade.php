@props(['state'])

@php
    use App\Utils\ReviewStarState;

    // Give the star the appropriate colour based on its state
    $stateClass = match ($state) {
        ReviewStarState::Filled => 'fill-violet-700',
        ReviewStarState::Half | ReviewStarState::Empty => 'fill-gray-600',
        default => 'fill-gray-600',
    };
@endphp

<svg class="size-6" viewBox="0 -19 550 550" xmlns="http://www.w3.org/2000/svg">
    <path d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z"
        class="{{ $stateClass }}" />
    @if ($state === ReviewStarState::Half)
        <path d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z"
            class="fill-violet-700" clip-path="url(#starColourClip)" />
        <defs>
            <clipPath id="starColourClip">
                <rect x="0" y="-19" width="275" height="550" />
            </clipPath>
        </defs>
    @endif
</svg>
