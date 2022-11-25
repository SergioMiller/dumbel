<?php
declare(strict_types=1);

namespace App\Tables;

use App\Constants\UserStatusConstant;
use App\Library\Table\Attributes\DateAttribute;
use App\Library\Table\Attributes\DatetimeAttribute;
use App\Library\Table\Attributes\LabelAttribute;
use App\Library\Table\Attributes\StringAttribute;
use App\Library\Table\Table;
use Illuminate\Database\Eloquent\Model;

class UserTable extends Table
{
    public function attributes(): array
    {
        return [
            new StringAttribute(['attribute' => 'id']),
            new StringAttribute(['attribute' => 'name']),
            new StringAttribute(['attribute' => 'lastname']),
            new StringAttribute(['attribute' => 'phone']),
            new StringAttribute(['attribute' => 'email']),
            new DateAttribute([
                'attribute' => 'birthday',
                'format' => 'd.m.Y'
            ]),
            new LabelAttribute([
                'attribute' => 'status',
                'labels' => [
                    UserStatusConstant::ACTIVE => [
                        'name' => 'Active',
                        'label' => 'success',
                    ],
                    UserStatusConstant::BLOCKED => [
                        'label' => 'danger'
                    ],
                ]
            ]),
            new DatetimeAttribute([
                'attribute' => 'created_at',
                'name' => 'Created at',
                'format' => 'd.m.Y H:i:s'
            ]),
        ];
    }

    public function actions(Model $item): array
    {
        return [
            [
                'route' => route('user.edit', $item->id),
                'class' => 'btn btn-sm btn-inverse icofont icofont-pencil-alt-2',
            ],
            [
                'route' => '#',
                'class' => 'btn btn-sm btn-danger icofont icofont-trash',
            ]
        ];
    }
}
