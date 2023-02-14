<?php

namespace Database\Factories;

use App\Enums\QrCodeSourceEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class QrCodeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'source' => QrCodeSourceEnum::ADMIN->value,
        ];
    }
}
