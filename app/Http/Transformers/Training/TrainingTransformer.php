<?php

declare(strict_types=1);

namespace App\Http\Transformers\Training;

use App\Library\Transformer\Transformer;
use App\Models\Training;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="TrainingTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="gym", type="object", ref="#/components/schemas/TrainingGymTransformer"),
 * @OA\Property(property="user", type="object", ref="#/components/schemas/TrainingUserTransformer")),
 * @OA\Property(property="gym_membership", type="object", ref="#/components/schemas/TrainingGymMembershipTransformer")),
 * @OA\Property(property="trainer", type="object", ref="#/components/schemas/TrainingTrainerTransformer")),
 * @OA\Property(property="manager", type="object", ref="#/components/schemas/TrainingManagerTransformer")),
 * @OA\Property(property="started_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 * @OA\Property(property="finished_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 * @OA\Property(property="updated_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 */
class TrainingTransformer extends Transformer
{
    public function toArray(Training $entity): array
    {
        return [
            'id' => $entity->id,
            'gym' => new TrainingGymTransformer($entity->gym),
            'user' => new TrainingUserTransformer($entity->user),
            'gym_membership' => new TrainingGymMembershipTransformer($entity->gymMembership),
            'trainer' => new TrainingTrainerTransformer($entity->trainer),
            'manager' => new TrainingManagerTransformer($entity->manager),
            'locker_number' => $entity->locker_number,
            'started_at' => $entity->started_at->toDatetimeString(),
            'finished_at' => $entity->finished_at,
            'created_at' => $entity->created_at->toDateTimeString(),
            'updated_at' => $entity->created_at->toDateTimeString(),
        ];
    }
}
