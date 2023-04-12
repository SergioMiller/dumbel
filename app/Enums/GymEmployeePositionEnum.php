<?php

declare(strict_types=1);

namespace App\Enums;

use App\Library\EnumHelper;

enum GymEmployeePositionEnum: string
{
    use EnumHelper;

    case TRAINER = 'trainer';
    case MANAGER = 'manager';
}
