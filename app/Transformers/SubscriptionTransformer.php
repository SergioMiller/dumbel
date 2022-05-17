<?php
declare(strict_types=1);

namespace App\Transformers;

use App\Library\Transformer;
use App\Models\Subscription;

class SubscriptionTransformer extends Transformer
{
    public function toArray(Subscription $subscription): array
    {
        return [
            'id' => $subscription->id,
            'gym_id' => $subscription->gym_id,
            'name' => $subscription->name,
            'day_quantity' => $subscription->day_quantity,
            'works_from' => $subscription->works_from,
            'works_to' => $subscription->works_to,
            'training_quantity' => $subscription->training_quantity,
            'price' => $subscription->price,
            'created_at' => $subscription->created_at->toDateTimeString(),
            'updated_at' => $subscription->updated_at->toDateTimeString(),
        ];
    }
}
