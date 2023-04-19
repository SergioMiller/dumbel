<?php

declare(strict_types=1);

namespace App\Http\Transformers\GymMembership;

use App\Library\Transformer\Transformer;
use App\Models\UserGymMembership;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="UserGymMembershipTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="user_id", type="integer", example="1"),
 * @OA\Property(property="gym_id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Gym membership name"),
 * @OA\Property(property="day_quantity", type="integer", example="35"),
 * @OA\Property(property="freeze_day_quantity", type="integer", example="7"),
 * @OA\Property(property="works_from", type="integer", example="8"),
 * @OA\Property(property="works_to", type="integer", example="21"),
 * @OA\Property(property="training_quantity", type="integer", example="12"),
 * @OA\Property(property="price", type="integer", example="720"),
 * @OA\Property(property="status", type="string", example="active"),
 * @OA\Property(property="date_start", type="string", format="datetime", example="2023-12-31"),
 * @OA\Property(property="date_end", type="string", format="datetime", example="2023-12-31"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 * @OA\Property(property="freezes", type="array", @OA\Items(ref="#/components/schemas/UserGymMembershipFreezeTransformer")),
 */
class UserGymMembershipTransformer extends Transformer
{
    public function toArray(UserGymMembership $entity): array
    {
        return [
            'id' => $entity->id,
            'user_id' => $entity->user_id,
            'gym_id' => $entity->gym_id,
            'gym_membership_id' => $entity->gym_membership_id,
            'name' => $entity->name,
            'day_quantity' => $entity->day_quantity,
            'freeze_day_quantity' => $entity->freeze_day_quantity,
            'works_from' => $entity->works_from,
            'works_to' => $entity->works_to,
            'training_quantity' => $entity->training_quantity,
            'price' => $entity->price,
            'status' => $entity->status,
            'date_start' => $entity->date_start,
            'date_end' => $entity->date_end,
            'created_at' => $entity->created_at->toDateTimeString(),
            'updated_at' => $entity->updated_at->toDateTimeString(),
            'freezes' => new UserGymMembershipFreezeTransformer($entity->freezes)
        ];
    }
}
