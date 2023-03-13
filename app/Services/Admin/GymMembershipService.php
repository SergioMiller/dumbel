<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\GymMembership;
use App\Repository\GymMembershipRepository;

class GymMembershipService
{
    public function __construct(private readonly GymMembershipRepository $gymMembershipRepository)
    {
    }

    public function update(int $id, array $data): GymMembership
    {
        return $this->gymMembershipRepository->update($id, $data);
    }
}
