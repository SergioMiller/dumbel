<?php

namespace Database\Factories;

use App\Enums\UserStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'              => $this->faker->name(),
            'lastname'          => $this->faker->lastName(),
            'phone'             => $this->faker->numberBetween(100000000000, 999999999999),
            'email'             => $this->faker->unique()->safeEmail(),
            'status'            => UserStatusEnum::ACTIVE->value,
            'email_verified_at' => Carbon::now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
