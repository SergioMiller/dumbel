<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Gym;
use Illuminate\Support\Collection;

class GymRepository
{
    public function getById(int $id): Gym|null
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return Gym::query()->where('id', $id)->first();
    }

    public function getByUserId($id): Collection
    {
        return Gym::query()->where('user_id', $id)->with(['trainers', 'managers'])->get();
    }
}
