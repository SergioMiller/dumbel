@extends('layouts.app')

@section('title')
    {{ $table->getTitle() }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="javascript:void(0)">{{ $table->getTitle() }}</a>
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-block">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        @foreach($attributes as $attribute)
                            <th>
                                @if($attribute->isSortable())
                                    @if(isset($table->getParams()['sort']) && array_key_exists($attribute->getKey(), $table->getParams()['sort']))
                                        @if($table->getParams()['sort'][$attribute->getKey()] === 'asc')
                                            <a href="{{ $table->getDescSortLink($attribute->getKey()) }}">
                                                {{ $attribute->getName() }}
                                                <i class="icofont icofont-long-arrow-up"></i>
                                            </a>
                                        @endif
                                        @if($table->getParams()['sort'][$attribute->getKey()] === 'desc')
                                            <a href="{{ $table->getAscSortLink($attribute->getKey()) }}">
                                                {{ $attribute->getName() }}
                                                <i class="icofont icofont-long-arrow-down"></i>
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ $table->getDefaultSortLink($attribute->getKey()) }}">
                                            {{ $attribute->getName() }}
                                            <i class="icofont icofont-rounded-expand"></i>
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
                    @foreach($paginator as $model)
                        <tr>
                            @foreach($attributes as $attribute)
                                <td>{!! $attribute->getValue($model) !!}</td>
                            @endforeach
                            <td>
                                @if($table->actions($model) !== [])

                                    @foreach($table->actions($model) as $action)
                                        <a class="{{ $action['class'] }}" href="{{ $action['route'] }}">
                                            @isset($action['text'])
                                                {{ $action['route'] }}
                                            @endisset
                                        </a>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-right">
                    {{ $paginator->appends($table->getParams())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
