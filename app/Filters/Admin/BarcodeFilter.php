<?php

declare(strict_types=1);

namespace App\Filters\Admin;

use App\Library\Filter;
use App\Models\Barcode;
use Illuminate\Support\Facades\DB;

class BarcodeFilter extends Filter
{
    protected string $model = Barcode::class;

    public function search(): Filter
    {
        $this->builder
            ->select([
                'barcodes.id',
                'barcodes.user_id',
                'barcodes.gym_id',
                DB::raw("CONCAT(users.name, ' ', users.lastname) AS user_full_name"),
                'gyms.name AS gym_name',
                'barcodes.code',
                'barcodes.type',
                'barcodes.encoding',
                'barcodes.created_at',
            ])
            ->distinct()
            ->leftJoin('users', 'barcodes.user_id', '=', 'users.id')
            ->leftJoin('gyms', 'barcodes.gym_id', '=', 'gyms.id');

        $this->filter();

        return $this;
    }
}
