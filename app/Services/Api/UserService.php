<?php
declare(strict_types=1);

namespace App\Services\Api;

use App\Models\QrCode;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function create(array $data): User
    {
        DB::beginTransaction();
        $user = new User($data);
        $user->save();
        QrCode::query()->where('uuid', $data['uuid'])->whereNull('user_id')->update(['user_id' => $user->id]);
        DB::commit();

        return $user;
    }
}
