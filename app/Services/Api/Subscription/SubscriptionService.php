<?php

declare(strict_types=1);

namespace App\Services\Api\Subscription;

use App\Models\Subscription;
use App\Services\Api\Subscription\Dto\SubscriptionCreateDto;
use App\Services\Api\Subscription\Dto\SubscriptionUpdateDto;

class SubscriptionService
{
    public function create(SubscriptionCreateDto $data): Subscription
    {
        $model = new Subscription($data->toArray());

        $model->save();

        return $model;
    }

    public function update(Subscription $model, SubscriptionUpdateDto $data): Subscription
    {
        $model->update($data->toArray());

        return $model->fresh();
    }
}
