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
                        <th>Id</th>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th style="width: 0;" class="text-right">
                            <a class="text-primary" href="{{ route('user.create') }}">Create</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table->paginator() as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->birthday }}</td>
                            <td>
                                @switch($user->status)
                                    @case('active')
                                    <label class="label label-inverse-success">{{ $user->status }}</label>
                                    @break
                                    @case('blocked')
                                    <label class="label label-inverse-danger">{{ $user->status }}</label>
                                    @break
                                @endswitch
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a class="btn btn-sm btn-inverse icofont icofont-pencil-alt-2"
                                   href="{{ route('user.edit', $user->id) }}"></a>
                                <a class="btn btn-sm btn-danger icofont icofont-trash" href="#"></a>
                            </td>
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
