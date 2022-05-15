@extends('layouts.app')

@section('title')
    Edit {{ $gym->name }}
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
                    <form id="main" method="post" action="{{ route('gym.update', $gym->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">User</label>
                            <div class="col-sm-10">
                                <select name="user_id"
                                        id="status"
                                        class="form-control @if($errors->has('user_id')) {{'is-invalid' }} @endif">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"
                                                @if($gym->user_id === $user->id) selected @endif>
                                            {{ $user->name }} {{ $user->lastname }}
                                        </option>
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
                                       value="{{ old('name', $user->name) }}">
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
                                       value="{{ old('description', $gym->description) }}">
                                @if($errors->has('description'))
                                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
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
                                       value="{{ old('phone', $gym->phone) }}">
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
                                       value="{{ old('email', $gym->email) }}">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
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
                                       value="{{ old('address', $gym->address) }}">
                                @if($errors->has('address'))
                                    <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Created at</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ $user->created_at }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Updated at</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ $user->updated_at }}" readonly>
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
