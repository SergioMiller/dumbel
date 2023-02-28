<?php

declare(strict_types=1);

namespace App\Transformers\User;

use App\Library\Transformer;
use App\Models\UserSubscription;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="UserSubscriptionTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="user_id", type="integer", example="1"),
 * @OA\Property(property="gym_id", type="integer", example="1"),
 * @OA\Property(property="administrator_id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Subscription name"),
 * @OA\Property(property="day_quantity", type="integer", example="35"),
 * @OA\Property(property="works_from", type="integer", example="8"),
 * @OA\Property(property="works_to", type="integer", example="21"),
 * @OA\Property(property="training_quantity", type="integer", example="12"),
 * @OA\Property(property="price", type="integer", example="720"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="10-10-2020 00:00:00"),
 */
class UserSubscriptionTransformer extends Transformer
{
    public function toArray(UserSubscription $userSubscription): array
    {
        return [
            'id' => $userSubscription->id,
            'user_id' => $userSubscription->user_id,
            'gym_id' => $userSubscription->gym_id,
            'administrator_id' => $userSubscription->administrator_id,
            'name' => $userSubscription->name,
            'day_quantity' => $userSubscription->day_quantity,
            'works_from' => $userSubscription->works_from,
            'works_to' => $userSubscription->works_to,
            'training_quantity' => $userSubscription->training_quantity,
            'price' => $userSubscription->price,
            'created_at' => $userSubscription->created_at,
        ];
    }
}
