<?php

declare(strict_types=1);

namespace App\Transformers\Account;

use App\Library\Transformer;
use App\Models\User;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="AccountTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Joh"),
 * @OA\Property(property="lastname", type="string", example="Doe"),
 * @OA\Property(property="phone", type="integer", example="380987654321"),
 * @OA\Property(property="email", type="string", format="email", example="email@email.email"),
 * @OA\Property(property="birthday", type="string", format="date", example="2023-12-31"),
 * @OA\Property(property="barcodes", type="array", @OA\Items(ref="#/components/schemas/AccountBarcodeTransformer")),
 */
class AccountTransformer extends Transformer
{
    public function toArray(User $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'lastname' => $model->lastname,
            'phone' => $model->phone,
            'email' => $model->email,
            'birthday' => $model->birthday,
            'barcodes' => new BarcodeTransformer($model->barcodes),
        ];
    }
}
