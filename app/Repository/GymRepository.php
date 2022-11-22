<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Gym;

class GymRepository
{
    public function getById(int $id): Gym|null
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return Gym::query()->where('id', $id)->first();
    }
}
