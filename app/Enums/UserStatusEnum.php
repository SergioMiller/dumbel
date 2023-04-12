<?php

declare(strict_types=1);

namespace App\Enums;

use App\Library\EnumHelper;

enum UserStatusEnum: string
{
    use EnumHelper;

    case ACTIVE = 'active';
    case BLOCKED = 'blocked';
}
