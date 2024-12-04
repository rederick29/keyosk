<?php
namespace App\Utils;

enum ReviewStarState: int {
    case Empty = 0;
    case Half = 1;
    case Filled = 2;
}
