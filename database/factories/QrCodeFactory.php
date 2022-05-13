<?php

namespace Database\Factories;

use App\Constants\QrCodeSourceConstant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class QrCodeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'source' => QrCodeSourceConstant::AUTOMATIC,
        ];
    }
}
