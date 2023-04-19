<?php

declare(strict_types=1);

namespace App\Http\Transformers\Training;

use App\Library\Transformer\Transformer;
use App\Models\UserGymMembership;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="TrainingGymMembershipTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Unlimit"),
 * @OA\Property(property="day_quantity", type="integer", example="31"),
 * @OA\Property(property="freeze_day_quantity", type="integer", example="7"),
 * @OA\Property(property="works_from", type="integer", example="9"),
 * @OA\Property(property="works_to", type="integer", example="21"),
 * @OA\Property(property="training_quantity", type="integer", example="12"),
 * @OA\Property(property="price", type="integer", example="800"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 */
class TrainingGymMembershipTransformer extends Transformer
{
    public function toArray(UserGymMembership $entity): array
    {
        return [
            'id' => $entity->id,
            'name' => $entity->name,
            'day_quantity' => $entity->day_quantity,
            'freeze_day_quantity' => $entity->freeze_day_quantity,
            'works_from' => $entity->works_from,
            'works_to' => $entity->works_to,
            'training_quantity' => $entity->training_quantity,
            'price' => $entity->price,
            'created_at' => $entity->created_at->toDateTimeString(),
        ];
    }
}
