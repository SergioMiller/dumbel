<?php
declare(strict_types=1);

namespace App\Transformers;

use App\Library\Transformer;
use App\Models\Gym;

/**
 * @OA\Schema(schema="GymTransformer")
 * @OA\Property(property="name", type="string", example="Gym"),
 * @OA\Property(property="description", type="string", example="Gym description."),
 * @OA\Property(property="phone", type="integer", example="380987654321"),
 * @OA\Property(property="email", type="string", format="email", example="email@email.email"),
 * @OA\Property(property="address", type="string", example="Cecelia Havens, 456 White Finch St.,North Augusta, SC 29860"),
 * @OA\Property(property="status", type="string", example="active"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="10-10-2020 00:00:00"),
 * @OA\Property(property="updated_at", type="string", format="datetime", example="10-10-2020 00:00:00"),
 */
class GymTransformer extends Transformer
{
    public function toArray(Gym $gym): array
    {
        return [
            'id' => $gym->id,
            'name' => $gym->name,
            'description' => $gym->description,
            'phone' => $gym->phone,
            'email' => $gym->email,
            'address' => $gym->address,
            'status' => $gym->status,
            'created_at' => $gym->created_at->toDateTimeString(),
            'updated_at' => $gym->updated_at->toDateTimeString(),
        ];
    }
}
