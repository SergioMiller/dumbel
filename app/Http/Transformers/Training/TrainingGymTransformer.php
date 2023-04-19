<?php

declare(strict_types=1);

namespace App\Http\Transformers\Training;

use App\Library\Transformer\Transformer;
use App\Models\Gym;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="TrainingGymTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Gym"),
 * @OA\Property(property="status", type="string", example="active"),
 * @OA\Property(property="updated_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 */
class TrainingGymTransformer extends Transformer
{
    public function toArray(Gym $entity): array
    {
        return [
            'id' => $entity->id,
            'name' => $entity->name,
            'status' => $entity->status,
            'created_at' => $entity->created_at->toDateTimeString(),
        ];
    }
}
