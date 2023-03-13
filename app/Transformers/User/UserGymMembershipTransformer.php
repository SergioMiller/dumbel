<?php

declare(strict_types=1);

namespace App\Transformers\User;

use App\Library\Transformer;
use App\Models\UserGymMembership;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="UserGymMembershipTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="user_id", type="integer", example="1"),
 * @OA\Property(property="gym_id", type="integer", example="1"),
 * @OA\Property(property="administrator_id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Gym membership name"),
 * @OA\Property(property="day_quantity", type="integer", example="35"),
 * @OA\Property(property="works_from", type="integer", example="8"),
 * @OA\Property(property="works_to", type="integer", example="21"),
 * @OA\Property(property="training_quantity", type="integer", example="12"),
 * @OA\Property(property="price", type="integer", example="720"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="10-10-2020 00:00:00"),
 */
class UserGymMembershipTransformer extends Transformer
{
    public function toArray(UserGymMembership $userGymMembership): array
    {
        return [
            'id' => $userGymMembership->id,
            'user_id' => $userGymMembership->user_id,
            'gym_id' => $userGymMembership->gym_id,
            'administrator_id' => $userGymMembership->administrator_id,
            'name' => $userGymMembership->name,
            'day_quantity' => $userGymMembership->day_quantity,
            'works_from' => $userGymMembership->works_from,
            'works_to' => $userGymMembership->works_to,
            'training_quantity' => $userGymMembership->training_quantity,
            'price' => $userGymMembership->price,
            'created_at' => $userGymMembership->created_at->toDateTimeString(),
        ];
    }
}
