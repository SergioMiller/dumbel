<?php
declare(strict_types=1);

namespace App\Library\Table;

use App\Library\Filter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

abstract class TableAbstract
{
    protected ?string $title = null;

    protected ?string $createUrl = null;

    protected object $params;

    protected Filter $filter;

    public function __construct(array $params)
    {
        if (isset($params['page'])) {
            unset($params['page']);
        }

        $this->params = (object) $params;
    }

    public function setFilter(string $class): self
    {
        $this->filter = new $class($this->params);

        return $this;
    }

    public function getParams(): array
    {
        return (array) $this->params;
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

    public function getDefaultSortLink(string $key): string
    {
        return route(Route::currentRouteName(), array_merge($this->getParams(), [
            'sort' => [$key => 'asc']
        ]));
    }

    public function getDescSortLink(string $key): string
    {
        return route(Route::currentRouteName(), array_merge($this->getParams(), [
            'sort' => [$key => 'desc']
        ]));
    }

    public function getAscSortLink(string $key): string
    {
        return route(Route::currentRouteName(), array_merge($this->getParams(), [
            'sort' => [$key => 'asc']
        ]));
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setCreateUrl(string $createUrl): static
    {
        $this->createUrl = $createUrl;

        return $this;
    }

    public function getCreateUrl(): ?string
    {
        return $this->createUrl;
    }
}
