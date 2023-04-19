<?php

declare(strict_types=1);

namespace App\Http\Transformers\Auth;

use App\Library\Transformer\Transformer;
use App\Models\User;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="AuthAccountTransformer")
 *
 * @OA\Property(property="name", type="string", example="Joh"),
 * @OA\Property(property="lastname", type="string", example="Doe"),
 * @OA\Property(property="phone", type="integer", example="380987654321"),
 * @OA\Property(property="email", type="string", format="email", example="email@email.email"),
 * @OA\Property(property="birthday", type="string", format="date", example="2023-12-31"),
 */
class AuthAccountTransformer extends Transformer
{
    public function toArray(User $entity): array
    {
        return [
            'name' => $entity->name,
            'lastname' => $entity->lastname,
            'phone' => $entity->phone,
            'email' => $entity->email,
            'birthday' => $entity->birthday,
        ];
    }
}
