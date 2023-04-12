<?php

declare(strict_types=1);

namespace App\Enums;

use App\Library\EnumHelper;

enum GymStatusEnum: string
{
    use EnumHelper;

    case ACTIVE = 'active';
    case MODERATION = 'moderation';
    case DEACTIVATED = 'deactivated';
}
