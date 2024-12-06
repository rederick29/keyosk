<?php

namespace App\Utils;

class ReviewStarState
{
    public const Filled = 'filled';
    public const Half = 'half';
    public const Empty = 'empty';

    /**
     * Calculate the star states based on the rating.
     *
     * @param int $rating The rating value (0–10).
     * @return array The array of star states (filled, half, empty).
     */
    public static function calculateStarStates(int $rating): array
    {
        // Calculate the number of filled stars (every 2 rating points is a filled star)
        $filledStars = intdiv($rating, 2);

        // Check if there is a half star (odd rating points)
        $halfStar = ($rating % 2) > 0;

        // Calculate the number of empty stars (5 total stars)
        $emptyStars = 5 - $filledStars - ($halfStar ? 1 : 0);

        // The array should look like this (as an example):
        // [filled, filled, half, empty, empty]
        return array_merge(
            array_fill(0, $filledStars, self::Filled),
            $halfStar ? [self::Half] : [],
            array_fill(0, $emptyStars, self::Empty)
        );
    }
}
