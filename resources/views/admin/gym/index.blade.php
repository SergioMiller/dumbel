@extends('layouts.app')

@section('title')
    {{ __('Gyms') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="#">{{ __('Gyms') }}</a>
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
                        <th>User</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Created at</th>
                        <th style="width: 0;" class="text-right">
                            <a class="text-primary" href="{{ route('gym.create') }}">Create</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($gyms as $gym)
                        <tr>
                            <td>{{ $gym->id }}</td>
                            <td>
                                <a href="{{ route('user.edit', $gym->user->id) }}">{{ $gym->user->name }}</a>
                            </td>
                            <td>{{ $gym->name }}</td>
                            <td>{{ $gym->description }}</td>
                            <td>{{ $gym->phone }}</td>
                            <td>{{ $gym->email }}</td>
                            <td>{{ $gym->address }}</td>
                            <td>{{ $gym->created_at }}</td>
                            <td>
                                <a class="btn btn-sm btn-inverse icofont icofont-pencil-alt-2"
                                   href="{{ route('gym.edit', $gym->id) }}"></a>
                                <a class="btn btn-sm btn-danger icofont icofont-trash" href="#"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-right">
                    {{ $gyms->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
