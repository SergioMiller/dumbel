<?php
declare(strict_types=1);

namespace App\Transformers;

use App\Library\Transformer;
use App\Models\User;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="AccountTransformer")
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Joh"),
 * @OA\Property(property="lastname", type="string", example="Doe"),
 * @OA\Property(property="phone", type="integer", example="380987654321"),
 * @OA\Property(property="email", type="string", format="email", example="email@email.email"),
 * @OA\Property(property="birthday", type="string", format="date", example="10-10-2020"),
 * @OA\Property(property="uuid", type="string", format="uuid", example="3fa85f64-5717-4562-b3fc-2c963f66afa6"),
 */
class AccountTransformer extends Transformer
{
    public function toArray(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'lastname' => $user->lastname,
            'phone' => $user->phone,
            'email' => $user->email,
            'birthday' => $user->birthday,
            'uuid' => $user->qrCode->uuid ?? null,
        ];
    }
}
