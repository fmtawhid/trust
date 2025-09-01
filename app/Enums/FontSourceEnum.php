<?php

namespace App\Enums;


use App\Traits\EnumToArray;

enum FontSourceEnum: string 
{
    use EnumToArray;

    case LOCAL = "1";
    case GOOGLE = "2";
}
