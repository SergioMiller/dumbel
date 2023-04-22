<?php

declare(strict_types=1);

namespace App\Library\Table\Attributes;

use Illuminate\Database\Eloquent\Model;

class ImageAttributeAbstract extends AttributeAbstract implements AttributeInterface
{
    private string $route;

    private string $parameter;

    private ?int $width;

    public function __construct(array $data)
    {
        $this->route = $data['image']['route'];
        $this->parameter = $data['image']['parameter'];
        $this->width = $data['image']['width'] ?? null;

        parent::__construct($data);
    }

    public function render(Model $entity, string $attribute): ?string
    {
        $parameter = $this->parameter;

        if ($entity->$parameter === null) {
            return '<span class="text-danger">-</span>';
        }

        if (null !== $this->width) {
            $width = 'width: 100px;';
        } else {
            $width = null;
        }

        return "<img src='" . route($this->route, $entity->$parameter) . "' style='$width'>";
    }
}
