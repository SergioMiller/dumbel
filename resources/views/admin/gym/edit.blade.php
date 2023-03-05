@extends('layouts.app')

@section('title')
    Редагування {{ $gym->name }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('gym.index') }}">{{ 'Спортивні зали' }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">{{ $gym->name }}</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form id="main" method="post" action="{{ route('gym.update', $gym->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">
                                <a href="{{ route('user.edit', $gym->user->id) }}">Власник</a>
                            </label>
                            <div class="col-sm-9">
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
                            <label class="col-sm-3 col-form-label">Назва</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control @if($errors->has('name')) {{'is-invalid' }} @endif"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $gym->name) }}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Опис</label>
                            <div class="col-sm-9">
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
                            <label class="col-sm-3 col-form-label">Телефон</label>
                            <div class="col-sm-9">
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
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
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
                            <label class="col-sm-3 col-form-label">Адреса</label>
                            <div class="col-sm-9">
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
                            <label class="col-sm-3 col-form-label">Статус</label>
                            <div class="col-sm-9">
                                <select name="status"
                                        id="status"
                                        class="form-control @if($errors->has('status')) {{'is-invalid' }} @endif">
                                    <option @if($gym->status === 'active') selected @endif value="active">Active
                                    </option>
                                    <option @if($gym->status === 'moderation') selected @endif  value="moderation">
                                        Moderation
                                    </option>
                                </select>

                                @if($errors->has('email'))
                                    <div class="messages">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Створено</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="{{ $gym->created_at }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Відредаговано</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="{{ $gym->updated_at }}" readonly>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary m-b-0">Зберегти</button>
                        </div>
                    </div>
                </form>
            </div>

            @if($gym->trainers->isNotEmpty())
                @include('admin/gym/_trainers', ['trainers' => $gym->trainers])
            @endif

            @if($gym->managers->isNotEmpty())
                @include('admin/gym/_managers', ['managers' => $gym->managers])
            @endif

        </div>

        @if($gym->subscriptions->isNotEmpty())
            <div class="col-md-6">
                @foreach($gym->subscriptions->sortBy('id') as $subscription)
                    @include('admin/gym/_subscription-edit', $subscription)
                @endforeach
            </div>
        @endif

    </div>
@endsection
