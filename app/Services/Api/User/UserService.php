<?php
declare(strict_types=1);

namespace App\Services\Api\User;

use App\Models\QrCode;
use App\Models\User;
use App\Services\Api\User\Dto\UserCreateDto;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function create(UserCreateDto $data): User
    {
        DB::beginTransaction();
        $user = new User($data->toArray());
        $user->save();
        QrCode::query()->where('uuid', $data->getUuid()->toString())->whereNull('user_id')->update(['user_id' => $user->id]);
        DB::commit();

        return $user;
    }
}
