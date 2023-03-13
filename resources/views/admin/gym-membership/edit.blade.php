@extends('layouts.app')

@section('title')
    Редагування {{ $membership->name }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('gym.index') }}">Спортивні зали</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('gym.edit', $membership->gym->id) }}">{{ $membership->gym->name }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ $membership->name }}
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form id="main" method="post" action="{{ route('gym-membership.update', $membership->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Назва <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control @if($errors->has('name')) {{'is-invalid' }} @endif"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $membership->name) }}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Кількість днів</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control @if($errors->has('day_quantity')) {{'is-invalid' }} @endif"
                                       name="day_quantity"
                                       id="day_quantity"
                                       value="{{ old('day_quantity', $membership->day_quantity) }}">
                                @if($errors->has('day_quantity'))
                                    <div class="invalid-feedback">{{ $errors->first('day_quantity') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Заморозка для карти в днях</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control @if($errors->has('freeze_day_quantity')) {{'is-invalid' }} @endif"
                                       name="freeze_day_quantity"
                                       id="freeze_day_quantity"
                                       value="{{ old('freeze_day_quantity', $membership->freeze_day_quantity) }}">
                                @if($errors->has('freeze_day_quantity'))
                                    <div class="invalid-feedback">{{ $errors->first('freeze_day_quantity') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Активний, з - до <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="text"
                                       class="form-control @if($errors->has('works_from')) {{'is-invalid' }} @endif"
                                       name="works_from"
                                       id="works_from"
                                       placeholder="Works from"
                                       value="{{ old('works_from', $membership->works_from) }}">
                                @if($errors->has('works_from'))
                                    <div class="invalid-feedback">{{ $errors->first('works_from') }}</div>
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <input type="text"
                                       class="form-control @if($errors->has('works_to')) {{'is-invalid' }} @endif"
                                       name="works_to"
                                       id="works_to"
                                       placeholder="Works to"
                                       value="{{ old('works_to', $membership->works_to) }}">
                                @if($errors->has('works_to'))
                                    <div class="invalid-feedback">{{ $errors->first('works_to') }}</div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Кількість тренувань</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control @if($errors->has('training_quantity')) {{'is-invalid' }} @endif"
                                       name="training_quantity"
                                       id="training_quantity"
                                       value="{{ old('training_quantity', $membership->training_quantity) }}">
                                @if($errors->has('training_quantity'))
                                    <div class="invalid-feedback">{{ $errors->first('training_quantity') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ціна <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control @if($errors->has('price')) {{'is-invalid' }} @endif"
                                       name="price"
                                       id="price"
                                       value="{{ old('price', $membership->price) }}">
                                @if($errors->has('price'))
                                    <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Створено</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="{{ $membership->created_at }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Відредаговано</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="{{ $membership->updated_at }}" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary m-b-0 float-right">Зберегти</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
