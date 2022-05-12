<?php
declare(strict_types=1);

namespace App\Services\Auth;

use App\Exceptions\PasswordDoesNotMatchException;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @param array $data
     *
     * @return string
     *
     * @throws UserNotFoundException
     * @throws PasswordDoesNotMatchException
     */
    public function login(array $data): string
    {
        /** @var User $user */
        $user = User::query()->where('phone', $data['phone'])->where('status', 'active')->first();

        if ($user === null) {
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
        $user = new User($data);
        $user->status = 'active';
        $user->save();

        return $this->generateApiToken($user, $data['device']);
    }
}
