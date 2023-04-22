<?php

declare(strict_types=1);

namespace App\Library\Table\Attributes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LabelAttributeAbstract extends AttributeAbstract implements AttributeInterface
{
    private array $labels;

    public function __construct(array $data)
    {
        $this->labels = $data['labels'];
        parent::__construct($data);
    }

    public function render(Model $entity, string $attribute): ?string
    {
        $value = $entity->$attribute;
        $label = $this->labels[$value]['label'] ?? 'primary';
        $value = $this->labels[$value]['name'] ?? Str::title($value);

        return "<label class='badge badge-{$label}'>{$value}</label>";
    }
}
