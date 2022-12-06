@extends('layouts.app')

@section('title')
    {{ __('Dashboard') }}
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

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-c-yellow update-card">
                        <div class="card-block">
                            <div class="row align-items-end">
                                <div class="col-8">
                                    <h4 class="text-white">$30200</h4>
                                    <h6 class="text-white m-b-0">All Earnings</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <p class="text-white m-b-0">
                                <i class="feather icon-clock text-white f-14 m-r-10"></i>
                                update : 2:15 am</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-c-green update-card">
                        <div class="card-block">
                            <div class="row align-items-end">
                                <div class="col-8">
                                    <h4 class="text-white">290+</h4>
                                    <h6 class="text-white m-b-0">Page Views</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <p class="text-white m-b-0">
                                <i class="feather icon-clock text-white f-14 m-r-10"></i>
                                update : 2:15 am</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-c-pink update-card">
                        <div class="card-block">
                            <div class="row align-items-end">
                                <div class="col-8">
                                    <h4 class="text-white">145</h4>
                                    <h6 class="text-white m-b-0">Task Completed</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <p class="text-white m-b-0">
                                <i class="feather icon-clock text-white f-14 m-r-10"></i>
                                update : 2:15 am</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-c-lite-green update-card">
                        <div class="card-block">
                            <div class="row align-items-end">
                                <div class="col-8">
                                    <h4 class="text-white">500</h4>
                                    <h6 class="text-white m-b-0">Downloads</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <p class="text-white m-b-0">
                                <i class="feather icon-clock text-white f-14 m-r-10"></i>
                                update : 2:15 am</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card social-card bg-simple-c-blue">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="feather icon-mail f-34 text-c-blue social-icon"></i>
                                </div>
                                <div class="col">
                                    <h6 class="m-b-0">Mail</h6>
                                    <p>231.2w downloads</p>
                                    <p class="m-b-0">Lorem Ipsum is simply dummy text of the
                                        printing</p>
                                </div>
                            </div>
                        </div>
                        <a href="#!" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card social-card bg-simple-c-pink">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="feather icon-twitter f-34 text-c-pink social-icon"></i>
                                </div>
                                <div class="col">
                                    <h6 class="m-b-0">twitter</h6>
                                    <p>231.2w downloads</p>
                                    <p class="m-b-0">Lorem Ipsum is simply dummy text of the
                                        printing</p>
                                </div>
                            </div>
                        </div>
                        <a href="#!" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12">
                    <div class="card social-card bg-simple-c-green">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="feather icon-instagram f-34 text-c-green social-icon"></i>
                                </div>
                                <div class="col">
                                    <h6 class="m-b-0">Instagram</h6>
                                    <p>231.2w downloads</p>
                                    <p class="m-b-0">Lorem Ipsum is simply dummy text of the
                                        printing</p>
                                </div>
                            </div>
                        </div>
                        <a href="#!" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
