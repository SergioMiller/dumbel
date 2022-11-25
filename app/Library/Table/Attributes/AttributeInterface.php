<?php
declare(strict_types=1);

namespace App\Library\Table\Attributes;

use Illuminate\Database\Eloquent\Model;

interface AttributeInterface
{
    public function render(Model $model, string $attribute);
}
