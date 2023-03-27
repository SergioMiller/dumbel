<?php

declare(strict_types=1);

namespace App\Enums;

use App\Library\EnumToArray;

enum GymMembershipStatusEnum: string
{
    use EnumToArray;

    case ACTIVE = 'active';
    case FREEZE = 'freeze';
}
