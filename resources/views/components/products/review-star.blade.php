@props(['state'])
<svg class="w-8 h-8" viewBox="0 -19 550 550" xmlns="http://www.w3.org/2000/svg">
    @php use \App\Utils\ReviewStarState;
    $e_state = ReviewStarState::tryFrom($state);
    @endphp
    @if ($e_state == ReviewStarState::Filled)
        <path d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" class="fill-yellow-400" />
    @elseif ($e_state == ReviewStarState::Empty)
        <path d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" class="fill-gray-600" />
    @elseif ($e_state == ReviewStarState::Half)
        <path d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" class="fill-gray-600" />
        <path d="M181 286L64 188 218 176 275 30 333 176 486 188 369 286 407 436 275 354 144 440 181 286Z" class="fill-yellow-400" clip-path="url(#starColourClip)" />
        <defs>
            <clipPath id="starColourClip">
                <rect x="0" y="-19" width="275" height="550" />
            </clipPath>
        </defs>
    @endif
</svg>
