@if ($notification = session()->get('success'))
    <div class="callout callout-success">
        <strong>{{ $notification }}</strong>
    </div>
@endif

@if ($notification = session()->get('error'))
    <div class="callout callout-danger">
        <strong>{{ $notification }}</strong>
    </div>
@endif

@if ($notification = session()->get('warning'))
    <div class="callout callout-warning">
        <strong>{{ $notification }}</strong>
    </div>
@endif

@if ($notification = session()->get('info'))
    <div class="callout callout-info">
        <strong>{{ $notification }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="callout callout-danger">
        Please check the form under for errors
    </div>
@endif