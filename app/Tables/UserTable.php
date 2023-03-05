<?php

declare(strict_types=1);

namespace App\Tables;

use App\Enums\UserStatusEnum;
use App\Library\Table\Attributes\DateAttributeAbstract;
use App\Library\Table\Attributes\DatetimeAttributeAbstract;
use App\Library\Table\Attributes\LabelAttributeAbstract;
use App\Library\Table\Attributes\StringAttributeAbstract;
use App\Library\Table\TableAbstract;
use Illuminate\Database\Eloquent\Model;

class UserTable extends TableAbstract
{
    public function attributes(): array
    {
        return [
            new StringAttributeAbstract([
                'attribute' => 'id',
                'name' => 'ІД',
                'sortable' => true
            ]),
            new StringAttributeAbstract([
                'attribute' => 'name',
                'name' => 'Імя',
                'sortable' => true
            ]),
            new StringAttributeAbstract([
                'attribute' => 'lastname',
                'name' => 'Фамілія',
                'sortable' => true
            ]),
            new StringAttributeAbstract([
                'attribute' => 'phone',
                'name' => 'Телефон',
                'sortable' => true
            ]),
            new StringAttributeAbstract([
                'attribute' => 'email',
                'name' => 'Email',
                'sortable' => true
            ]),
            new DateAttributeAbstract([
                'attribute' => 'birthday',
                'name' => 'Дата народження',
                'format' => 'd.m.Y',
                'sortable' => true
            ]),
            new LabelAttributeAbstract([
                'attribute' => 'status',
                'name' => 'Статус',
                'labels' => [
                    UserStatusEnum::ACTIVE->value => [
                        'name' => 'Active',
                        'label' => 'success',
                    ],
                    UserStatusEnum::BLOCKED->value => [
                        'label' => 'danger'
                    ],
                ]
            ]),
            new DatetimeAttributeAbstract([
                'attribute' => 'created_at',
                'name' => 'Створено',
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
                'class' => 'btn btn-sm btn-primary',
                'icon' => '<i class="fas fa-pen"></i>',
            ],
            [
                'route' => '#',
                'class' => 'btn btn-sm btn-danger',
                'icon' => '<i class="fas fa-trash"></i>',
            ]
        ];
    }
}
