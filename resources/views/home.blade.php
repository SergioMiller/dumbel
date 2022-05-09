@extends('layouts.app')

@section('title')
    {{ __('Dashboard') }}
@endsection

@section('subtitle')
    {{ __('Subtitle') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="#">{{ __('Dashboard') }}</a>
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{ __('You are logged in!') }}
        </div>
    </div>
@endsection
