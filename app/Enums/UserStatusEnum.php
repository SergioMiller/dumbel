<?php

declare(strict_types=1);

namespace App\Enums;

use App\Library\EnumToArray;

enum UserStatusEnum: string
{
    use EnumToArray;

    case ACTIVE = 'active';
    case BLOCKED = 'blocked';
}
