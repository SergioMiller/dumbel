<?php

declare(strict_types=1);

namespace App\Transformers\Gym;

use App\Library\Transformer;
use App\Models\User;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="EmployeeTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Joh"),
 * @OA\Property(property="lastname", type="string", example="Dou"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 */
class EmployeeTransformer extends Transformer
{
    public function toArray(User $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'lastname' => $model->lastname,
            'created_at' => $model->created_at->toDateTimeString(),
        ];
    }
}
