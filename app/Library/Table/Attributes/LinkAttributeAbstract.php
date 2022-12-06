<?php
declare(strict_types=1);

namespace App\Library\Table\Attributes;

use Illuminate\Database\Eloquent\Model;

class LinkAttributeAbstract extends AttributeAbstract implements AttributeInterface
{
    private string $route;

    private string $parameter;

    public function __construct(array $data)
    {
        $this->route = $data['link']['route'];
        $this->parameter = $data['link']['parameter'];

        parent::__construct($data);
    }

    public function render(Model $model, string $attribute): ?string
    {
        $parameter = $this->parameter;

        if ($model->$parameter === null) {
            return '<span class="text-danger">-</span>';
        }

        return "<a href='" . route($this->route, $model->$parameter) . "'>" . $model->$attribute . '</a>';
    }
}
