@if ($notification = session()->get('success'))
    <div class="alert alert-success border-success">
        <strong>{{ $notification }}</strong>
    </div>
@endif

@if ($notification = session()->get('error'))
    <div class="alert alert-danger border-danger">
        <strong>{{ $notification }}</strong>
    </div>
@endif

@if ($notification = session()->get('warning'))
    <div class="alert alert-warning border-warning">
        <strong>{{ $notification }}</strong>
    </div>
@endif

@if ($notification = session()->get('info'))
    <div class="alert alert-info border-info">
        <strong>{{ $notification }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger border-danger">
        Please check the form under for errors
    </div>
@endif