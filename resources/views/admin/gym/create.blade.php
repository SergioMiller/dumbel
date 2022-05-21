@extends('layouts.app')

@section('title')
    {{ __('Create gym') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('gym.index') }}">{{ __('Gyms') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">{{ __('Create gym') }}</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-block">
                    <form id="main" method="post" action="{{ route('gym.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">User</label>
                            <div class="col-sm-10">
                                <select name="user_id"
                                        id="status"
                                        class="form-control @if($errors->has('user_id')) {{'is-invalid' }} @endif">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->lastname }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('user_id'))
                                    <div class="messages">{{ $errors->first('user_id') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control @if($errors->has('name')) {{'is-invalid' }} @endif"
                                       name="name"
                                       id="name"
                                       value="{{ old('name') }}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control @if($errors->has('description')) {{'is-invalid' }} @endif"
                                       name="description"
                                       id="description"
                                       value="{{ old('description') }}">
                                @if($errors->has('description'))
                                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control @if($errors->has('address')) {{'is-invalid' }} @endif"
                                       name="address"
                                       id="address"
                                       value="{{ old('address') }}">
                                @if($errors->has('address'))
                                    <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control @if($errors->has('phone')) {{'is-invalid' }} @endif"
                                       name="phone"
                                       id="phone"
                                       value="{{ old('phone') }}">
                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email"
                                       class="form-control @if($errors->has('email')) {{'is-invalid' }} @endif"
                                       name="email"
                                       id="email"
                                       value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status"
                                        id="status"
                                        class="form-control @if($errors->has('status')) {{'is-invalid' }} @endif">
                                    <option value="active">Active</option>
                                    <option value="moderation">Moderation</option>
                                </select>

                                @if($errors->has('status'))
                                    <div class="messages">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="float-right">
                            <button type="submit" class="btn btn-primary m-b-0">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
