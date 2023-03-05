@extends('layouts.app')

@section('title')
    Створити спортивний зал
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('gym.index') }}">Спортивні зали</a>
    </li>
    <li class="breadcrumb-item">
        Створити спортивний зал
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form id="main" method="post" action="{{ route('gym.store') }}">
                    @csrf
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Власник <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="user_id"
                                        id="status"
                                        class="form-control @if($errors->has('user_id')) {{'is-invalid' }} @endif">
                                    <option>Не вибрано</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->lastname }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('user_id'))
                                    <div class="invalid-feedback">{{ $errors->first('user_id') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Назва <span class="text-danger">*</span></label>
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
                            <label class="col-sm-2 col-form-label">Опис</label>
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
                            <label class="col-sm-2 col-form-label">Адреса <span class="text-danger">*</span></label>
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
                            <label class="col-sm-2 col-form-label">Телефон</label>
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
                            <label class="col-sm-2 col-form-label">Статус</label>
                            <div class="col-sm-10">
                                <select name="status"
                                        id="status"
                                        class="form-control @if($errors->has('status')) {{'is-invalid' }} @endif">
                                    <option value="active">Активний</option>
                                    <option value="moderation">На модерації</option>
                                </select>

                                @if($errors->has('status'))
                                    <div class="messages">{{ $errors->first('status') }}</div>
                                @endif
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
