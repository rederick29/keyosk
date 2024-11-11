<?php
namespace App\Models\Tag;

use App\Utils\EnumArrayHelper;

enum TagType: String
{
    use EnumArrayHelper;

    case Colour = "colour";
    case Attribute = "attribute";
    case Compatibility = "compatibility";
}
