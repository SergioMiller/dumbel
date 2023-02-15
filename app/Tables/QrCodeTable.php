<?php
declare(strict_types=1);

namespace App\Tables;

use App\Enums\QrCodeSourceEnum;
use App\Library\Table\Attributes\LabelAttributeAbstract;
use App\Library\Table\Attributes\LinkAttributeAbstract;
use App\Library\Table\Attributes\StringAttributeAbstract;
use App\Library\Table\TableAbstract;

class QrCodeTable extends TableAbstract
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
                'attribute' => 'uuid',
                'name' => 'UUID',
                'sortable' => true
            ]),
            new LabelAttributeAbstract([
                'attribute' => 'source',
                'name' => 'Джерело',
                'sortable' => true,
                'labels' => [
                    QrCodeSourceEnum::AUTOMATIC->value => [
                        'name' => 'Automatic',
                        'label' => 'warning',
                    ],
                    QrCodeSourceEnum::ADMIN->value => [
                        'label' => 'primary'
                    ],
                ]
            ]),
            new StringAttributeAbstract([
                'attribute' => 'last_used_at',
                'name' => 'Last used at',
                'sortable' => true
            ]),
            new StringAttributeAbstract([
                'attribute' => 'created_at',
                'name' => 'created at',
                'sortable' => true
            ]),
        ];
    }
}
