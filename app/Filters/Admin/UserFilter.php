<?php

declare(strict_types=1);

namespace App\Filters\Admin;

use App\Library\Filter;
use App\Models\User;

class UserFilter extends Filter
{
    protected string $model = User::class;

    protected function name(string $value): void
    {
        $this->builder->where('users.name', 'ilike', "%$value%");
    }
}
