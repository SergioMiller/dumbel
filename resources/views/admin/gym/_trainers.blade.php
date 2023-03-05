<div class="card">
    <div class="card-footer">
        <strong>{{ __('Тренери') }}</strong>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ІД</th>
                <th>Імя</th>
                <th>Телефон</th>
                <th style="width: 0;" class="text-right"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($trainers as $trainer)
                <tr>
                    <td>{{ $trainer->id }}</td>
                    <td>{{ $trainer->name }} {{ $trainer->lastname }}</td>
                    <td>{{ $trainer->phone }}</td>
                    <td>
                        <a class="btn btn-sm btn-inverse icofont icofont-pencil-alt-2"
                           href="{{ route('user.edit', $trainer->id) }}">
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>