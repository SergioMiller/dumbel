<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function store(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->store($data);
    }

    public function update(int $id, array $data): User
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->userRepository->update($id, $data);
    }
}
