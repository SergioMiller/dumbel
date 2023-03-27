<?php

declare(strict_types=1);

namespace App\Tables;

use App\Enums\BarcodeTypeEnum;
use App\Library\Table\Attributes\DatetimeAttributeAbstract;
use App\Library\Table\Attributes\ImageAttributeAbstract;
use App\Library\Table\Attributes\LabelAttributeAbstract;
use App\Library\Table\Attributes\LinkAttributeAbstract;
use App\Library\Table\Attributes\StringAttributeAbstract;
use App\Library\Table\TableAbstract;

class BarcodeTable extends TableAbstract
{
    public function attributes(): array
    {
        return [
            new StringAttributeAbstract([
                'attribute' => 'id',
                'name' => 'ІД',
                'sortable' => true
            ]),
            new ImageAttributeAbstract([
                'attribute' => 'id',
                'name' => 'ІД',
                'image' => [
                    'width' => 120,
                    'route' => 'user.barcode',
                    'parameter' => 'id',
                ]
            ]),
            new LinkAttributeAbstract([
                'attribute' => 'user_full_name',
                'name' => 'Користувач',
                'link' => [
                    'route' => 'user.edit',
                    'parameter' => 'user_id',
                ]
            ]),
            new LinkAttributeAbstract([
                'attribute' => 'gym_name',
                'name' => 'Спортивний зал',
                'link' => [
                    'route' => 'gym.edit',
                    'parameter' => 'gym_id',
                ]
            ]),
            new StringAttributeAbstract([
                'attribute' => 'code',
                'name' => 'Код',
                'sortable' => true
            ]),
            new LabelAttributeAbstract([
                'attribute' => 'type',
                'name' => 'Тип',
                'sortable' => true,
                'labels' => [
                    BarcodeTypeEnum::SYSTEM->value => [
                        'name' => 'System',
                        'label' => 'success',
                    ],
                    BarcodeTypeEnum::GYM->value => [
                        'name' => 'Gym',
                        'label' => 'primary'
                    ],
                ]
            ]),
            new StringAttributeAbstract([
                'attribute' => 'encoding',
                'name' => 'Кодування',
                'sortable' => true
            ]),
            new DatetimeAttributeAbstract([
                'attribute' => 'created_at',
                'name' => 'Створено',
                'format' => 'd.m.Y H:i:s',
                'sortable' => true
            ]),
        ];
    }
}
