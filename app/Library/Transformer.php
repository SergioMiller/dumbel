<?php
declare(strict_types=1);

namespace App\Library;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

abstract class Transformer
{
    protected $data;

    protected ?User $user;

    public function __construct($data, ?User $user = null)
    {
        $this->data = $data;
        $this->user = $user;
    }

    public function convert(): ?array
    {
        if ($this->data === null) {
            return null;
        }

        if ($this->data instanceof Collection || is_array($this->data)) {
            $list = [];
            foreach ($this->data as $item) {
                $list[] = $this->toArray($item);
            }

            return $list;
        }

        return $this->toArray($this->data);
    }

    public function transform(): array
    {
        if ($this->data instanceof Collection) {
            $list = [];
            foreach ($this->data as $item) {
                $list[] = $this->build($this->toArray($item));
            }

            return $list;
        }

        return $this->build($this->toArray($this->data));
    }

    private function build($data): array
    {
        $list = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $list[$key] = $this->build($value);
            } elseif ($this->isTransformer($value)) {
                $list[$key] = $this->build($value->transform());
            } else {
                $list[$key] = $value;
            }
        }

        return $list;
    }

    private function isTransformer($data): bool
    {
        return is_subclass_of($data, self::class);
    }
}
