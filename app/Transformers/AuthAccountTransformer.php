<?php
declare(strict_types=1);

namespace App\Transformers;

use App\Library\Transformer;
use App\Models\User;

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
