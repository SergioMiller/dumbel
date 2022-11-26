<?php
declare(strict_types=1);

namespace App\Tables;

use App\Constants\UserStatusConstant;
use App\Library\Table\Attributes\DateAttributeAbstract;
use App\Library\Table\Attributes\DatetimeAttributeAbstract;
use App\Library\Table\Attributes\LabelAttributeAbstract;
use App\Library\Table\Attributes\StringAttributeAbstract;
use App\Library\Table\TableAbstract;
use Illuminate\Database\Eloquent\Model;

class UserTableAbstract extends TableAbstract
{
    public function attributes(): array
    {
        return [
            new StringAttributeAbstract(['attribute' => 'id', 'sortable' => true]),
            new StringAttributeAbstract(['attribute' => 'name', 'sortable' => true]),
            new StringAttributeAbstract(['attribute' => 'lastname']),
            new StringAttributeAbstract(['attribute' => 'phone']),
            new StringAttributeAbstract(['attribute' => 'email']),
            new DateAttributeAbstract([
                'attribute' => 'birthday',
                'format' => 'd.m.Y',
                'sortable' => true
            ]),
            new LabelAttributeAbstract([
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
            new DatetimeAttributeAbstract([
                'attribute' => 'created_at',
                'name' => 'Created at',
                'format' => 'd.m.Y H:i:s',
                'sortable' => true
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
