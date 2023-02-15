<?php
declare(strict_types=1);

namespace App\Services\Auth;

use App\Enums\QrCodeSourceEnum;
use App\Enums\UserStatusEnum;
use App\Exceptions\PasswordDoesNotMatchException;
use App\Exceptions\UserNotFoundException;
use App\Models\QrCode;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $this->saveQrCode($user, $data);
        DB::commit();

        return $this->generateApiToken($user, $data['device']);
    }

    private function saveQrCode(User $user, array $data): void
    {
        if (isset($data['uuid'])) {
            $qrCode = QrCode::query()->where('uuid', $data['uuid'])->whereNull('user_id')->first();
        } else {
            $qrCode = new QrCode();
            $qrCode->uuid = Str::uuid();
            $qrCode->source = QrCodeSourceEnum::AUTOMATIC->value;
        }

        $qrCode->user_id = $user->id;

        $qrCode->save();
    }

    public function checkQrCode(string $uuid): bool
    {
        return QrCode::query()->where('uuid', $uuid)->whereNull('user_id')->exists();
    }

    public function registerWithQrCode(QrCode $qrCode, array $data): string
    {
        $data['password'] = Hash::make($data['password']);

        $user = $qrCode->user;
        $user->update($data);

        return $this->generateApiToken($user, $data['device']);
    }
}
