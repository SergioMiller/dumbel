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
                        <th>Email</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th style="width: 0"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><label class="label label-inverse-success">active</label></td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary">
                                    <i class="icofont icofont-pencil-alt-2"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="icofont icofont-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-right">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
