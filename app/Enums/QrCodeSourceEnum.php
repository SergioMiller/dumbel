<?php
declare(strict_types=1);

namespace App\Enums;

use App\Library\EnumToArray;

enum QrCodeSourceEnum: string
{
    use EnumToArray;

    case AUTOMATIC = 'automatic';

    case ADMIN = 'admin';
}
