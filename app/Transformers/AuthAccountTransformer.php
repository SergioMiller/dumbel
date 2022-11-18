<?php
declare(strict_types=1);

namespace App\Transformers;

use App\Library\Transformer;
use App\Models\User;

/**
 * @OA\Schema(schema="AuthAccountTransformer")
 * @OA\Property(property="name", type="string", example="Joh"),
 * @OA\Property(property="lastname", type="string", example="Doe"),
 * @OA\Property(property="phone", type="integer", example="380987654321"),
 * @OA\Property(property="email", type="string", format="email", example="email@email.email"),
 * @OA\Property(property="birthday", type="string", format="date", example="10-10-2020"),
 */
class AuthAccountTransformer extends Transformer
{
    public function toArray(User $user): array
    {
        return [
            'name' => $user->name,
            'lastname' => $user->lastname,
            'phone' => $user->phone,
            'email' => $user->email,
            'birthday' => $user->birthday,
        ];
    }
}
