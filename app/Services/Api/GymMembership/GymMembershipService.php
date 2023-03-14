<?php

declare(strict_types=1);

namespace App\Services\Api\GymMembership;

use App\Models\GymMembership;
use App\Services\Api\GymMembership\Dto\GymMembershipCreateDto;
use App\Services\Api\GymMembership\Dto\GymMembershipUpdateDto;

class GymMembershipService
{
    public function create(GymMembershipCreateDto $data): GymMembership
    {
        $model = new GymMembership($data->toArray());

        $model->save();

        return $model;
    }

    public function update(GymMembership $model, GymMembershipUpdateDto $data): GymMembership
    {
        $model->update($data->toArray());

        return $model->fresh();
    }
}
