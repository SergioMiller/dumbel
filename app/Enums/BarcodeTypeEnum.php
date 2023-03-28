<?php

declare(strict_types=1);

namespace App\Enums;

use App\Library\EnumToArray;

enum BarcodeTypeEnum: string
{
    use EnumToArray;

    case DEFAULT = 'default';
    case GYM = 'gym';
}
