<?php

declare(strict_types=1);

namespace App\Library;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class Filter
{
    protected object $params;

    protected string $model;

    protected Builder $builder;

    protected string $table;

    protected ?User $user;

    public function __construct(object $params, ?User $user = null)
    {
        $this->params = $params;
        $this->builder = app($this->model)->newQuery();
        $this->table = $this->builder->getModel()->getTable();
        $this->user = $user;
    }

    public function search(): Filter
    {
        $this->filter();

        return $this;
    }

    protected function filter(): Filter
    {
        $defaultOrder = true;

        foreach ($this->params as $field => $value) {
            if ('sort' === $field && !empty($value)) {
                $defaultOrder = false;
            }

            if (!empty($value) && method_exists($this, $field)) {
                if (is_string($value)) {
                    $this->$field(trim($value));
                } else {
                    $this->$field($value);
                }
            }
        }

        if (true === $defaultOrder) {
            $this->defaultOrder();
        }

        return $this;
    }

    public function get(): Collection
    {
        return $this->builder->get();
    }

    public function paginate(): Paginator
    {
        $limit = $this->params->limit ?? 20;
        $page = $this->params->page ?? 0;

        return new Paginator($this->builder, (int) $limit, (int) $page);
    }

    protected function defaultOrder(): Builder
    {
        return $this->builder->orderByDesc("$this->table.id");
    }

    /**
     * @param array|string $datetime
     */
    protected function created_at(array|string $datetime): void
    {
        if (is_string($datetime)) {
            $this->builder->where("$this->table.created_at", $this->prepareUtc($datetime));

            return;
        }

        if (!empty($datetime['from']) && !empty($datetime['to'])) {
            $this->builder->whereBetween("$this->table.created_at", [
                $this->prepareUtc($datetime['from']),
                $this->prepareUtc($datetime['to'])
            ]);
        } elseif (!empty($datetime['from'])) {
            $this->builder->where("$this->table.created_at", '>=', $this->prepareUtc($datetime['from']));
        } elseif (!empty($datetime['to'])) {
            $this->builder->where("$this->table.created_at", '<=', $this->prepareUtc($datetime['to']));
        }
    }

    protected function sort(array $sort): void
    {
        foreach ($sort as $field => $direction) {
            $this->builder->orderBy("$this->table.$field", $direction);
        }
    }

    public function getBuilder(): Builder
    {
        return $this->builder;
    }

    private function prepareUtc(string $datetime): string
    {
        return date('Y-m-d H:i:s', strtotime($datetime) - ($this->user->utc->seconds ?? 0));
    }
}
