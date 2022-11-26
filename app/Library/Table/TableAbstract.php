<?php
declare(strict_types=1);

namespace App\Library\Table;

use App\Library\Filter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

abstract class TableAbstract
{
    protected object $params;

    protected Filter $filter;

    public function __construct(array $params)
    {
        $this->params = (object)$params;
    }

    public function setFilter(string $class): self
    {
        $this->filter = new $class($this->params);

        return $this;
    }

    public function getParams(): array
    {
        return (array)$this->params;
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

    public function getLinks(): Htmlable
    {
        return $this->paginator()->appends($this->getParams())->links();
    }

    public function getDefaultSortLink(string $key): string
    {
        $params = $this->getParams();
        if (isset($params['page'])) {
            unset($params['page']);
        }
        return route(Route::currentRouteName(), array_merge($this->getParams(), [
            'sort' => [$key => 'asc']
        ]));
    }

    public function getDescSortLink(string $key): string
    {
        $params = $this->getParams();
        if (isset($params['page'])) {
            unset($params['page']);
        }
        return route(Route::currentRouteName(), array_merge($params, [
            'sort' => [$key => 'desc']
        ]));
    }

    public function getAscSortLink(string $key): string
    {
        $params = $this->getParams();
        if (isset($params['page'])) {
            unset($params['page']);
        }
        return route(Route::currentRouteName(), array_merge($params, [
            'sort' => [$key => 'asc']
        ]));
    }
}
