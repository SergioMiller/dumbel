<?php

declare(strict_types=1);

namespace App\Filters\Admin;

use App\Library\Filter;
use App\Models\Gym;
use Illuminate\Support\Facades\DB;

class GymFilter extends Filter
{
    protected string $entity = Gym::class;

    public function search(): Filter
    {
        $this->builder
            ->leftJoin('users', 'gyms.user_id', '=', 'users.id')
            ->select([
                'gyms.id',
                'gyms.user_id',
                DB::raw("CONCAT(users.name, ' ', users.lastname) AS user_full_name"),
                'gyms.name',
                'gyms.phone',
                'gyms.address',
                'gyms.email',
                'gyms.status',
                'gyms.created_at',
            ]);

        $this->filter();

        return $this;
    }
}
