@extends('layouts.app')

@section('title')
    Edit {{ $subscription->name }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('gym.index') }}">{{ __('Gyms') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('gym.edit', $subscription->gym->id) }}">{{ $subscription->gym->name }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">{{ $subscription->name }}</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="main" method="post" action="{{ route('subscription.update', $subscription->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control @if($errors->has('name')) {{'is-invalid' }} @endif"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $subscription->name) }}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Day quantity</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control @if($errors->has('day_quantity')) {{'is-invalid' }} @endif"
                                       name="day_quantity"
                                       id="day_quantity"
                                       value="{{ old('day_quantity', $subscription->day_quantity) }}">
                                @if($errors->has('day_quantity'))
                                    <div class="invalid-feedback">{{ $errors->first('day_quantity') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Works time <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="text"
                                       class="form-control @if($errors->has('works_from')) {{'is-invalid' }} @endif"
                                       name="works_from"
                                       id="works_from"
                                       placeholder="Works from"
                                       value="{{ old('works_from', $subscription->works_from) }}">
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
                                       value="{{ old('works_to', $subscription->works_to) }}">
                                @if($errors->has('works_to'))
                                    <div class="invalid-feedback">{{ $errors->first('works_to') }}</div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Training quantity</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control @if($errors->has('training_quantity')) {{'is-invalid' }} @endif"
                                       name="training_quantity"
                                       id="training_quantity"
                                       value="{{ old('training_quantity', $subscription->training_quantity) }}">
                                @if($errors->has('training_quantity'))
                                    <div class="invalid-feedback">{{ $errors->first('training_quantity') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Price <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control @if($errors->has('price')) {{'is-invalid' }} @endif"
                                       name="price"
                                       id="price"
                                       value="{{ old('price', $subscription->price) }}">
                                @if($errors->has('price'))
                                    <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Created at</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="{{ $subscription->created_at }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Updated at</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="{{ $subscription->updated_at }}" readonly>
                            </div>
                        </div>

                        <div class="float-right">
                            <button type="submit" class="btn btn-primary m-b-0">Зберегти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
