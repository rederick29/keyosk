<?php

namespace App\Models\Subscription;

use App\Utils\EnumArrayHelper;

enum SubscriptionTiers: string
{
    use EnumArrayHelper;

    case Plus = "plus";
    case Premium = "premium";
    case Deluxe = "deluxe";

    public function getGradient(): string
    {
         return match ($this) {
            self::Plus => "subscription-plus",
            self::Premium => "subscription-premium",
            self::Deluxe => "subscription-deluxe",
        };
    }
}
