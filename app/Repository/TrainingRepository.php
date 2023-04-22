<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Training;

class TrainingRepository
{
    public function __construct(private readonly Training $entity)
    {
    }

    public function getById(int $id): Training|null
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->entity::query()->where('id', $id)->first();
    }
}
