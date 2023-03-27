<?php

declare(strict_types=1);

namespace App\Services\Api\User;

use App\Models\User;
use App\Services\Api\User\Dto\UserCreateDto;
use App\Services\BarcodeService;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function __construct(private readonly BarcodeService $barcodeService)
    {
    }

    public function create(UserCreateDto $data): User
    {
        DB::beginTransaction();
        $user = new User($data->toArray());
        $user->save();
        #TODO:create client card

        $this->barcodeService->generate();
        DB::commit();

        return $user;
    }
}
