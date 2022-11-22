<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Collection;

class SubscriptionRepository
{
    public function getById(int $id): Subscription|null
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return Subscription::query()->where('id', $id)->first();
    }

    public function getListByGymId(int $id): Collection
    {
        return Subscription::query()->where('gym_id', $id)->orderBy('price')->get();
    }
}
