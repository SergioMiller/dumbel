<?php

declare(strict_types=1);

namespace App\Http\Transformers\Gym;

use App\Library\Transformer\Transformer;
use App\Models\Gym;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="GymTransformer")
 *
 * @OA\Property(property="name", type="string", example="Gym"),
 * @OA\Property(property="description", type="string", example="Gym description."),
 * @OA\Property(property="phone", type="integer", example="380987654321"),
 * @OA\Property(property="email", type="string", format="email", example="email@email.email"),
 * @OA\Property(property="address", type="string", example="Cecelia Havens, 456 White Finch St.,North Augusta, SC 29860"),
 * @OA\Property(property="status", type="string", example="active"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 * @OA\Property(property="updated_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 * @OA\Property(property="trainers", type="array", @OA\Items(ref="#/components/schemas/EmployeeTransformer")),
 * @OA\Property(property="managers", type="array", @OA\Items(ref="#/components/schemas/EmployeeTransformer")),
 */
class GymTransformer extends Transformer
{
    public function toArray(Gym $entity): array
    {
        return [
            'id' => $entity->id,
            'name' => $entity->name,
            'description' => $entity->description,
            'phone' => $entity->phone,
            'email' => $entity->email,
            'address' => $entity->address,
            'status' => $entity->status,
            'created_at' => $entity->created_at->toDateTimeString(),
            'updated_at' => $entity->updated_at->toDateTimeString(),
            'trainers' => new EmployeeTransformer($entity->trainers),
            'managers' => new EmployeeTransformer($entity->managers),
        ];
    }
}