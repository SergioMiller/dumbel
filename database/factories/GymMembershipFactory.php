<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GymMembershipFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'day_quantity' => 45,
            'freeze_day_quantity' => 7,
            'works_from' => $this->faker->numberBetween(7, 10),
            'works_to' => $this->faker->numberBetween(20, 22),
            'training_quantity' => $this->faker->numberBetween(8, 12),
            'price' => $this->faker->numberBetween(500, 900),
        ];
    }
}
