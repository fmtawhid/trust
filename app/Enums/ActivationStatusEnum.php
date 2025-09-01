<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ActivationStatusEnum: string
{
    use EnumToArray;

    case INACTIVE = "0";
    case ACTIVE   = "1";
}
