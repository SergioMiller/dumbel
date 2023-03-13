<?php

declare(strict_types=1);

namespace App\Transformers\Gym;

use App\Library\Transformer;
use App\Models\GymMembership;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="GymMembershipTransformer")
 *
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
class GymMembershipTransformer extends Transformer
{
    public function toArray(GymMembership $gymMembership): array
    {
        return [
            'id' => $gymMembership->id,
            'gym_id' => $gymMembership->gym_id,
            'name' => $gymMembership->name,
            'day_quantity' => $gymMembership->day_quantity,
            'works_from' => $gymMembership->works_from,
            'works_to' => $gymMembership->works_to,
            'training_quantity' => $gymMembership->training_quantity,
            'price' => $gymMembership->price,
            'created_at' => $gymMembership->created_at->toDateTimeString(),
            'updated_at' => $gymMembership->updated_at->toDateTimeString(),
        ];
    }
}
