@extends('layouts.app')

@section('title')
    {{ __('QR code') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="#">{{ __('QR code') }}</a>
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
                        <th>UUID</th>
                        <th>Source</th>
                        <th>Last used at</th>
                        <th>Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($qrCodes as $qrCode)
                        <tr>
                            <td>{{ $qrCode->id }}</td>
                            <td>{{ $qrCode->user->name ?? null }} {{ $qrCode->user->lastname ?? null}}</td>
                            <td>{{ $qrCode->uuid }}</td>
                            <td>
                                <label class="label label-inverse-primary">{{ $qrCode->source }}</label>
                            </td>
                            <td>{{ $qrCode->last_used_at }}</td>
                            <td>{{ $qrCode->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-right">
                    {{ $qrCodes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
