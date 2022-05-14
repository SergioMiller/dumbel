<?php
declare(strict_types=1);

namespace App\Services\Auth;

use App\Constants\QrCodeSourceConstant;
use App\Constants\UserStatusConstant;
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
        $user = User::query()->where('phone', $data['phone'])->where('status', UserStatusConstant::ACTIVE)->first();

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
        DB::beginTransaction();
        $user = new User($data);
        $user->status = UserStatusConstant::ACTIVE;
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
            $qrCode->source = QrCodeSourceConstant::AUTOMATIC;
        }

        $qrCode->user_id = $user->id;

        $qrCode->save();
    }
}
