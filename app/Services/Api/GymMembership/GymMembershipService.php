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
        $entity = new GymMembership($data->toArray());

        $entity->save();

        return $entity;
    }

    public function update(GymMembership $entity, GymMembershipUpdateDto $data): GymMembership
    {
        $entity->update($data->toArray());

        return $entity->fresh();
    }
}
