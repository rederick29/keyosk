<?php

namespace App\Utils;

enum CartUpdateAction: string
{
    case Increase = "increase";
    case Decrease = "decrease";
    case Remove = "remove";
    case Add = "add";

    // If the action is Increase or Decrease, we need a quantity, otherwise we don't
    public static function needsQuantity(string $action): bool
    {
        return in_array(needle: $action, haystack: [self::Increase, self::Decrease], strict: true);
    }
}
