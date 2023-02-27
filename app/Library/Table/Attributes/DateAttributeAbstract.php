<?php

declare(strict_types=1);

namespace App\Library\Table\Attributes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class DateAttributeAbstract extends AttributeAbstract implements AttributeInterface
{
    private string $format;

    public function __construct(array $data)
    {
        $this->format = $data['format'] ?? 'd-y-m';
        parent::__construct($data);
    }

    public function render(Model $model, string $attribute): ?string
    {
        /**
         * @var null|Carbon $value
         */
        $value = $model->$attribute;

        if (null === $value) {
            return null;
        }

        if (is_string($value)) {
            $value = Carbon::create($value);
        }

        return $value->format($this->format);
    }
}
