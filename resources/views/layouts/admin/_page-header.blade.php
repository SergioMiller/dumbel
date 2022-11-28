<div class="page-header">
    <div class="row">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>@yield('title')</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a>
                    </li>
                    @yield('breadcrumb')
                </ul>
            </div>
        </div>
    </div>
</div>