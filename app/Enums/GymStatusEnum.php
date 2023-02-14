<?php
declare(strict_types=1);

namespace App\Enums;

use App\Library\EnumToArray;

enum GymStatusEnum: string
{
    use EnumToArray;

    case ACTIVE = 'active';

    case MODERATION = 'moderation';
}
