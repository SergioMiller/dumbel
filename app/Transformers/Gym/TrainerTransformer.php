<?php

declare(strict_types=1);

namespace App\Transformers\Gym;

use App\Library\Transformer;
use App\Models\User;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="TrainerTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Joh"),
 * @OA\Property(property="lastname", type="string", example="Dou"),
 */
class TrainerTransformer extends Transformer
{
    public function toArray(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'lastname' => $user->lastname,
        ];
    }
}
