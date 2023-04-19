<?php

declare(strict_types=1);

namespace App\Http\Transformers\Training;

use App\Library\Transformer\Transformer;
use App\Models\User;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="TrainingUserTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Joh"),
 * @OA\Property(property="lastname", type="string", example="Dou"),
 * @OA\Property(property="phone", type="integer", example="380987654321"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 */
class TrainingUserTransformer extends Transformer
{
    public function toArray(User $entity): array
    {
        return [
            'id' => $entity->id,
            'name' => $entity->name,
            'lastname' => $entity->lastname,
            'phone' => $entity->phone,
            'created_at' => $entity->created_at->toDateTimeString(),
        ];
    }
}
