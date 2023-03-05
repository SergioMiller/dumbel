@extends('layouts.app')

@section('title')
    Редагування {{ $user->name }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('user.index') }}">Користувачі</a>
    </li>
    <li class="breadcrumb-item">
        Редагування {{ $user->name }}
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form id="main" method="post" action="{{ route('user.update', $user->id) }}">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Імʼя <span class="text-danger">*</span></label>
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
                            <label class="col-sm-2 col-form-label">Фамілія <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control @if($errors->has('lastname')) {{'is-invalid' }} @endif"
                                       name="lastname"
                                       id="lastname"
                                       value="{{ old('lastname', $user->lastname) }}">
                                @if($errors->has('lastname'))
                                    <div class="invalid-feedback">{{ $errors->first('lastname') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Телефон <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control @if($errors->has('phone')) {{'is-invalid' }} @endif"
                                       name="phone"
                                       id="phone"
                                       value="{{ old('phone', $user->phone) }}">
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
                                       value="{{ old('email', $user->email) }}">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Статус</label>
                            <div class="col-sm-10">
                                <select name="status"
                                        id="status"
                                        class="form-control @if($errors->has('status')) {{'is-invalid' }} @endif">
                                    <option @if($user->status === 'active') selected @endif value="active">Активний
                                    </option>
                                    <option @if($user->status === 'blocked') selected @endif  value="blocked">
                                        Заблокований
                                    </option>
                                </select>

                                @if($errors->has('email'))
                                    <div class="messages">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">День народження</label>
                            <div class="col-sm-9">
                                <input type="date"
                                       class="form-control @if($errors->has('birthday')) {{'is-invalid' }} @endif"
                                       name="birthday"
                                       id="birthday"
                                       value="{{ old('birthday', $user->birthday) }}">
                                @if($errors->has('birthday'))
                                    <div class="invalid-feedback">{{ $errors->first('birthday') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Uuid</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ $user->qrCode->uuid ?? null }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Пароль</label>
                            <div class="col-sm-10">
                                <input type="password"
                                       class="form-control @if($errors->has('password')) {{'is-invalid' }} @endif"
                                       autocomplete="new-password"
                                       name="password"
                                       id="password"
                                       value="{{ old('password') }}">
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Створено</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="{{ $user->created_at }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Відредаговано</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="{{ $user->updated_at }}" readonly>
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
        </div>
    </div>
@endsection
