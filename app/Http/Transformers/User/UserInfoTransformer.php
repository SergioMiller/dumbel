<?php

declare(strict_types=1);

namespace App\Http\Transformers\User;

use App\Library\Transformer\Transformer;
use App\Models\User;
use App\HttpTransformers\GymMembership\UserGymMembershipTransformer;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="UserInfoTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Joh"),
 * @OA\Property(property="lastname", type="string", example="Dou"),
 * @OA\Property(property="phone", type="integer", example="380987654321"),
 * @OA\Property(property="email", type="string", format="email", example="email@email.email"),
 * @OA\Property(property="birthday", type="string", format="date", example="2023-12-31"),
 * @OA\Property(property="barcodes", type="array", @OA\Items(ref="#/components/schemas/UserBarcodeTransformer")),
 * @OA\Property(property="gym_memberships", type="array", @OA\Items(ref="#/components/schemas/UserGymMembershipTransformer")),
 */
class UserInfoTransformer extends Transformer
{
    public function toArray(User $entity): array
    {
        return [
            'id' => $entity->id,
            'name' => $entity->name,
            'lastname' => $entity->lastname,
            'phone' => $entity->phone,
            'email' => $entity->email,
            'birthday' => $entity->birthday,
            'barcodes' => new BarcodeTransformer($entity->barcodes),
            'gym_memberships' => new UserGymMembershipTransformer($entity->gymMemberships),
        ];
    }
}
