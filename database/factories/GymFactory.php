<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Enums\GymStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GymFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(255),
            'phone' => $this->faker->numberBetween(100000000000, 999999999999),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address,
            'status' => GymStatusEnum::ACTIVE->value,
            'created_at' => Carbon::now()->toDateTimeString(),
        ];
    }
}
