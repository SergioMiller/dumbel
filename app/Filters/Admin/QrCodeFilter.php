<?php

declare(strict_types=1);

namespace App\Filters\Admin;

use App\Library\Filter;
use App\Models\QrCode;
use Illuminate\Support\Facades\DB;

class QrCodeFilter extends Filter
{
    protected string $model = QrCode::class;

    public function search(): Filter
    {
        $this->builder
            ->leftJoin('users', 'qr_codes.user_id', '=', 'users.id')
            ->select([
                'qr_codes.id',
                'qr_codes.user_id',
                DB::raw("CONCAT(users.name, ' ', users.lastname) AS user_full_name"),
                'qr_codes.uuid',
                'qr_codes.source',
                'qr_codes.last_used_at',
                'qr_codes.created_at',
            ]);

        $this->filter();

        return $this;
    }
}
