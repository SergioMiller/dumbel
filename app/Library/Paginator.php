<?php

declare(strict_types=1);

namespace App\Library;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Paginator
{
    private Builder $builder;

    private int $limit;

    private int $page;

    public function __construct(Builder $builder, int $limit = 20, int $page = 1)
    {
        $this->builder = $builder;
        $this->limit = $limit;
        $this->page = $page;
    }

    public function get(): Collection
    {
        $builder = clone $this->builder->limit($this->limit);

        if (1 !== $this->page) {
            if ($this->page < 1) {
                $this->page = 1;
            }

            $builder->offset(($this->page - 1) * $this->limit);
        }

        return $builder->get();
    }

    public function getTotal(): int
    {
        $table = $this->builder->getModel()->getTable();

        return $this->builder->count("$table.id");
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getMeta(): array
    {
        return [
            'total' => $this->getTotal(),
            'limit' => $this->getLimit(),
            'page' => $this->getPage(),
        ];
    }
}
