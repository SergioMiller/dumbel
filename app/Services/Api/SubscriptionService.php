<?php
declare(strict_types=1);

namespace App\Services\Api;

use App\Models\Subscription;

class SubscriptionService
{
    public function create(array $data): Subscription
    {
        $model = new Subscription($data);

        $model->save();

        return $model;
    }

    public function update(Subscription $model, array $data): Subscription
    {
        $model->update($data);

        return $model->fresh();
    }
}
