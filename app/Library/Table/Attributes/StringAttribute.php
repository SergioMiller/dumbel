<?php
declare(strict_types=1);

namespace App\Library\Table\Attributes;

use Illuminate\Database\Eloquent\Model;

class StringAttribute extends Attribute implements AttributeInterface
{
    public function render(Model $model, string $attribute): ?string
    {
        return (string)$model->$attribute;
    }
}
