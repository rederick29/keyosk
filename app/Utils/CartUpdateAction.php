<?php

namespace App\Utils;

enum CartUpdateAction: string
{
    case Increase = "increase";
    case Decrease = "decrease";
    case Remove = "remove";
    case Add = "add";

    public static function needsQuantity(?string $action): bool
    {
        if ($action === null) {
            return false;
        }

        return in_array($action, [self::Increase, self::Decrease], true);
    }
}
