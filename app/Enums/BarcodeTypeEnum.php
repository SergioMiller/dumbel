<?php

declare(strict_types=1);

namespace App\Enums;

use App\Library\EnumHelper;

enum BarcodeTypeEnum: string
{
    use EnumHelper;

    case DEFAULT = 'default';
    case GYM = 'gym';
}
