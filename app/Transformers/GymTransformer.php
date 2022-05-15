<?php
declare(strict_types=1);

namespace App\Transformers;

use App\Library\Transformer;
use App\Models\Gym;

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
            'created_at' => $gym->created_at->toDateTimeString(),
            'updated_at' => $gym->updated_at->toDateTimeString(),
        ];
    }
}
