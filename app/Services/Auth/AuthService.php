<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Enums\UserStatusEnum;
use App\Exceptions\PasswordDoesNotMatchException;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @throws PasswordDoesNotMatchException
     * @throws UserNotFoundException
     */
    public function login(array $data): string
    {
        /** @var User $user */
        $user = User::query()->where('phone', $data['phone'])->where('status', UserStatusEnum::ACTIVE->value)->first();

        if (null === $user) {
            throw new UserNotFoundException();
        }

        if (!Hash::check($data['password'], $user->password)) {
            throw new PasswordDoesNotMatchException();
        }

        return $this->generateApiToken($user, $data['device']);
    }

    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }

    public function generateApiToken(User $user, string $device): string
    {
        return $user->createToken($device)->plainTextToken;
    }

    public function register(array $data): string
    {
        DB::beginTransaction();
        $data['password'] = Hash::make($data['password']);
        $user = new User($data);
        $user->status = UserStatusEnum::ACTIVE->value;
        $user->save();
        #TODO:create client card
        DB::commit();

        return $this->generateApiToken($user, $data['device']);
    }
}
