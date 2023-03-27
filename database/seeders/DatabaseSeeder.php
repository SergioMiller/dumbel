<?php

namespace Database\Seeders;

use App\Enums\UserStatusEnum;
use App\Models\Barcode;
use App\Models\Gym;
use App\Models\GymMembership;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->insertOrIgnore([
            'name'              => 'Serhii',
            'lastname'          => 'Melnyk',
            'phone'             => 380989277704,
            'email'             => 'serik1995m@gmail.com',
            'status'            => UserStatusEnum::ACTIVE->value,
            'email_verified_at' => Carbon::now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);

        if (App::isLocal()) {
            User::factory(10)
                ->has(
                    Gym::factory()->has(
                        GymMembership::factory()->count(6)
                    )->count(3)
                )
                ->has(Barcode::factory()->count(1))
                ->create();
        }
    }
}
