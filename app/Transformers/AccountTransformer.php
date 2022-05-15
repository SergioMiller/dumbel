<?php
declare(strict_types=1);

namespace App\Transformers;

use App\Library\Transformer;
use App\Models\User;

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
            'uuid' => $user->qrCode->uuid,
        ];
    }
}
