<?php

declare(strict_types=1);

namespace App\Library;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use InvalidArgumentException;
use JsonSerializable;

class JsonResponse extends \Illuminate\Http\JsonResponse
{
    public function setData($data = []): static
    {
        if (!empty($data['data'])) {
            $data = $this->preparingData($data);
        }

        $this->original = $data;

        if ($data instanceof Jsonable) {
            $this->data = $data->toJson($this->encodingOptions);
        } elseif ($data instanceof JsonSerializable) {
            $this->data = json_encode($data->jsonSerialize(), JSON_THROW_ON_ERROR | $this->encodingOptions);
        } elseif ($data instanceof Arrayable) {
            $this->data = json_encode($data->toArray(), $this->encodingOptions);
        } else {
            $this->data = json_encode($data, $this->encodingOptions);
        }

        if (!$this->hasValidJson(json_last_error())) {
            throw new InvalidArgumentException(json_last_error_msg());
        }

        return $this->update();
    }

    private function preparingData($data): ?array
    {
        if (null === $data) {
            return null;
        }

        if ($this->isTransformer($data)) {
            $data = $data->convert();
        }

        $list = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $list[$key] = $this->preparingData($value);
            } elseif ($this->isTransformer($value)) {
                $list[$key] = $this->preparingData($value->convert());
            } else {
                $list[$key] = $value;
            }
        }

        return $list;
    }

    private function isTransformer($data): bool
    {
        return is_subclass_of($data, Transformer::class);
    }
}
