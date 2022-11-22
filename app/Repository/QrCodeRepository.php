<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\QrCode;
use Ramsey\Uuid\UuidInterface;

class QrCodeRepository
{
    public function getWithUserWhereIsEmptyPassword(UuidInterface $uuid): QrCode|null
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return QrCode::query()->where('uuid', $uuid)->whereNotNull('user_id')->first();
    }
}
