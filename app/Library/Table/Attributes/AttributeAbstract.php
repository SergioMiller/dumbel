<?php

declare(strict_types=1);

namespace App\Library\Table\Attributes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class AttributeAbstract
{
    protected string $attribute;

    protected string $name;

    protected bool $sortable;

    public function __construct(array $data)
    {
        $this->attribute = (string) ($data['attribute'] ?? '');
        $this->name = (string) ($data['name'] ?? '');
        $this->sortable = filter_var($data['sortable'] ?? false, FILTER_VALIDATE_BOOL);
    }

    public function getKey(): string
    {
        return $this->attribute;
    }

    public function getName(): string
    {
        if (empty($this->name)) {
            return Str::title(str_replace('_', ' ', $this->attribute));
        }

        return $this->name;
    }

    public function getValue(Model $model): ?string
    {
        return $this->render($model, $this->attribute);
    }

    public function isSortable(): bool
    {
        return $this->sortable;
    }
}
