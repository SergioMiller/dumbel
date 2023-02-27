<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    public function store(array $data): User
    {
        $model = new User($data);

        $model->save();

        return $model;
    }

    public function update(int $id, array $data): User
    {
        /**
         * @var User $model
         */
        $model = User::query()->where('id', $id)->firstOrFail();

        $model->update($data);

        return $model->fresh();
    }

    public function getById(int $id): User|null
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return User::query()->where('id', $id)->first();
    }
}
