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
                            <th>{{ $attribute->getName() }}</th>
                        @endforeach
                        <th style="width: 0;" class="text-right">
                            <a class="text-primary" href="{{ route('user.create') }}">Create</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table->paginator() as $model)
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
                    {{ $table->paginator()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
