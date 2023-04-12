<?php

declare(strict_types=1);

namespace App\Enums;

use App\Library\EnumHelper;

enum GymMembershipStatusEnum: string
{
    use EnumHelper;

    case ACTIVE = 'active';
    case FREEZE = 'freeze';
}
