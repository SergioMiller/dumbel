@extends('layouts.app')

@section('title')
    {{ __('Users') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="#">{{ __('Users') }}</a>
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
                                                <i class="icofont icofont-arrow-up"></i>
                                            </a>
                                        @endif
                                        @if($table->getParams()['sort'][$attribute->getKey()] === 'desc')
                                            <a href="{{ $table->getAscSortLink($attribute->getKey()) }}">
                                                {{ $attribute->getName() }}
                                                <i class="icofont icofont-arrow-down"></i>
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ $table->getDefaultSortLink($attribute->getKey()) }}">
                                            {{ $attribute->getName() }}
                                            <i class="icofont icofont-sort"></i>
                                        </a>
                                    @endisset
                                @else
                                    {{ $attribute->getName() }}
                                @endif
                            </th>
                        @endforeach
                        <th style="width: 0;" class="text-right">
                            <a class="text-primary" href="{{ route('user.create') }}">Create</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($paginator as $model)
                        <tr>
                            @foreach($attributes as $attribute)
                                <td>{!! $attribute->getValue($model) !!}</td>
                            @endforeach

                            @if($table->actions($model) !== [])
                                <td>
                                    @foreach($table->actions($model) as $action)
                                        <a class="{{ $action['class'] }}" href="{{ $action['route'] }}">
                                            @isset($action['text'])
                                                {{ $action['route'] }}
                                            @endisset
                                        </a>
                                    @endforeach
                                </td>
                            @endif
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
