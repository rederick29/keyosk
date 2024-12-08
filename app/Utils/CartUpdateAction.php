<?php

namespace App\Utils;

enum CartUpdateAction: string
{
    case Increase = "increase";
    case Decrease = "decrease";
    case Remove = "remove";
    case Add = "add";

    public static function needsQuantity(String $action): bool
    {
        if (!$action) return false;
        if ($action == self::Increase || $action == self::Decrease) return true;
        return false;
    }
}
