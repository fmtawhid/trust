<?php

namespace App\Enums;


use App\Traits\EnumToArray;

enum FontSetupEnum: string 
{
    use EnumToArray;

    case PRINCIPAL = "1";
    case ALTERNATE = "2";
    case SUPPLEMENTARY = "3";
}
