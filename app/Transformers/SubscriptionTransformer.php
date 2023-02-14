<?php
declare(strict_types=1);

namespace App\Transformers;

use App\Library\Transformer;
use App\Models\Subscription;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="SubscriptionTransformer")
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="gym_id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Unlimit"),
 * @OA\Property(property="day_quantity", type="integer", example="31"),
 * @OA\Property(property="works_from", type="integer", example="9"),
 * @OA\Property(property="works_to", type="integer", example="21"),
 * @OA\Property(property="training_quantity", type="integer", example="12"),
 * @OA\Property(property="price", type="integer", example="800"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="10-10-2020 00:00:00"),
 * @OA\Property(property="updated_at", type="string", format="datetime", example="10-10-2020 00:00:00"),
 */
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
