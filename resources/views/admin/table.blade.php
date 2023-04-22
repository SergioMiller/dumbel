@extends('layouts.app')

@section('title')
    {{ $table->getTitle() }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        {{ $table->getTitle() }}
    </li>
@endsection

@section('content')
    <div class="card">
        <table class="table table-striped">
            <thead>
            <tr>
                @foreach($attributes as $attribute)
                    <th>
                        @if($attribute->isSortable())
                            @if(isset($table->getParams()['sort']) && array_key_exists($attribute->getKey(), $table->getParams()['sort']))
                                @if($table->getParams()['sort'][$attribute->getKey()] === 'asc')
                                    <a href="{{ $table->getDescSortLink($attribute->getKey()) }}"
                                       class="text-default admin-sort">
                                        {{ $attribute->getName() }}
                                        <i class="fas fa-sort-amount-up"></i>
                                    </a>
                                @endif
                                @if($table->getParams()['sort'][$attribute->getKey()] === 'desc')
                                    <a href="{{ $table->getAscSortLink($attribute->getKey()) }}"
                                       class="text-default admin-sort">
                                        {{ $attribute->getName() }}
                                        <i class="fas fa-sort-amount-down"></i>
                                    </a>
                                @endif
                            @else
                                <a href="{{ $table->getDefaultSortLink($attribute->getKey()) }}"
                                   class="text-default admin-sort">
                                    {{ $attribute->getName() }}
                                    <i class="fas fa-sort"></i>
                                </a>
                            @endisset
                        @else
                            {{ $attribute->getName() }}
                        @endif
                    </th>
                @endforeach
                <th style="width: 0;" class="text-right">
                    @if($createUrl = $table->getCreateUrl() )
                        <a class="text-primary" href="{{ $createUrl }}">Створити</a>
                    @endif
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($paginator as $entity)
                <tr>
                    @foreach($attributes as $attribute)
                        <td>{!! $attribute->getValue($entity) !!}</td>
                    @endforeach
                    <td>
                        @if($table->actions($entity) !== [])

                            @foreach($table->actions($entity) as $action)
                                <a class="{{ $action['class'] }}" href="{{ $action['route'] }}">
                                    @isset($action['icon'])
                                        {!! $action['icon'] !!}
                                    @endisset
                                    @isset($action['text'])
                                        {{ $action['text'] }}
                                    @endisset
                                </a>
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="row no-print">
            <div class="col-12">
                <div class="float-right pr-3">
                    {{ $paginator->appends($table->getParams())->links() }}
                </div>
            </div>
        </div>


    </div>
@endsection
