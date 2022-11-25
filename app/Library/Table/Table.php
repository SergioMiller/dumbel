<?php
declare(strict_types=1);

namespace App\Library\Table;

use App\Library\Filter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Table
{
    protected object $params;

    protected Filter $filter;

    public function __construct(array $params)
    {
        $this->params = (object) $params;
    }

    public function setFilter(string $class): self
    {
        $this->filter = new $class($this->params);

        return $this;
    }

    public function items(): Collection
    {
        return $this->filter->get();
    }

    public function paginator(): LengthAwarePaginator
    {
        return $this->filter->search()->getBuilder()->paginate();
    }

    protected function columns(): array
    {
        return [];
    }

    public function actions(Model $item): array
    {
        return [];
    }
}
