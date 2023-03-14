<?php

declare(strict_types=1);

namespace App\Transformers\GymMembership;

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
 * @OA\Property(property="freeze_day_quantity", type="integer", example="7"),
 * @OA\Property(property="works_from", type="integer", example="8"),
 * @OA\Property(property="works_to", type="integer", example="21"),
 * @OA\Property(property="training_quantity", type="integer", example="12"),
 * @OA\Property(property="price", type="integer", example="720"),
 * @OA\Property(property="status", type="string", example="active"),
 * @OA\Property(property="date_start", type="string", format="datetime", example="10-10-2020"),
 * @OA\Property(property="date_end", type="string", format="datetime", example="10-10-2020"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="10-10-2020 00:00:00"),
 */
class UserGymMembershipTransformer extends Transformer
{
    public function toArray(UserGymMembership $gymMembership): array
    {
        return [
            'id' => $gymMembership->id,
            'user_id' => $gymMembership->user_id,
            'gym_id' => $gymMembership->gym_id,
            'gym_membership_id' => $gymMembership->gym_membership_id,
            'administrator_id' => $gymMembership->administrator_id,
            'name' => $gymMembership->name,
            'day_quantity' => $gymMembership->day_quantity,
            'freeze_day_quantity' => $gymMembership->freeze_day_quantity,
            'works_from' => $gymMembership->works_from,
            'works_to' => $gymMembership->works_to,
            'training_quantity' => $gymMembership->training_quantity,
            'price' => $gymMembership->price,
            'status' => $gymMembership->status,
            'date_start' => $gymMembership->date_start,
            'date_end' => $gymMembership->date_start,
            'created_at' => $gymMembership->created_at->toDateTimeString(),
            'updated_at' => $gymMembership->created_at->toDateTimeString(),
        ];
    }
}
