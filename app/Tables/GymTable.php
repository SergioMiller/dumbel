<?php

declare(strict_types=1);

namespace App\Tables;

use App\Enums\GymStatusEnum;
use App\Library\Table\Attributes\DatetimeAttributeAbstract;
use App\Library\Table\Attributes\LabelAttributeAbstract;
use App\Library\Table\Attributes\LinkAttributeAbstract;
use App\Library\Table\Attributes\StringAttributeAbstract;
use App\Library\Table\TableAbstract;
use Illuminate\Database\Eloquent\Model;

class GymTable extends TableAbstract
{
    public function attributes(): array
    {
        return [
            new StringAttributeAbstract([
                'attribute' => 'id',
                'name' => 'ІД',
                'sortable' => true
            ]),
            new LinkAttributeAbstract([
                'attribute' => 'user_full_name',
                'name' => 'Користувач',
                'link' => [
                    'route' => 'user.edit',
                    'parameter' => 'user_id',
                ]
            ]),
            new StringAttributeAbstract([
                'attribute' => 'name',
                'name' => 'Назва',
                'sortable' => true
            ]),
            new StringAttributeAbstract([
                'attribute' => 'phone',
                'name' => 'Телефон',
                'sortable' => true
            ]),
            new StringAttributeAbstract([
                'attribute' => 'address',
                'name' => 'Адреса',
                'sortable' => true
            ]),
            new StringAttributeAbstract([
                'attribute' => 'email',
                'name' => 'Email',
                'sortable' => true
            ]),
            new LabelAttributeAbstract([
                'attribute' => 'status',
                'name' => 'Статус',
                'sortable' => true,
                'labels' => [
                    GymStatusEnum::ACTIVE->value => [
                        'name' => 'Active',
                        'label' => 'success',
                    ],
                    GymStatusEnum::MODERATION->value => [
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
                'route' => route('gym.edit', $item->id),
                'class' => 'btn btn-sm btn-inverse icofont icofont-pencil-alt-2',
            ],
            [
                'route' => '#',
                'class' => 'btn btn-sm btn-danger icofont icofont-trash',
            ]
        ];
    }
}
