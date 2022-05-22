<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\QrCode;

class QrCodeRepository
{
    public function getWithUserWhereIsEmptyPassword(string $uuid): QrCode | null
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return QrCode::query()->where('uuid', $uuid)->whereNotNull('user_id')->first();
    }
}
