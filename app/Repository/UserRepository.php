<?php

declare(strict_types=1);

namespace App\Repository;

use App\Enums\BarcodeTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function getByBarcodeForGym(string $barcode, int $gymId): User|null
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return User::query()
            ->with([
                'gymMemberships' => fn (HasMany $query) => $query
                    ->where('user_gym_memberships.gym_id', $gymId)
                    ->latest(),
                'barcodes' => fn (HasMany $query) => $query
                    ->where('barcodes.type', BarcodeTypeEnum::DEFAULT->value)
                    ->latest(),
            ])
            ->whereHas('barcodes', fn (Builder $query) => $query->where('barcodes.code', $barcode))
            ->first();
    }
}
