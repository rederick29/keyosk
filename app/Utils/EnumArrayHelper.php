<?php
namespace App\Utils;

trait EnumArrayHelper
{
    public static function getEnumValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
