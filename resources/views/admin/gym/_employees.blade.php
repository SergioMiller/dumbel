<div class="card">
    <div class="card-footer">
        <strong>{{ __('Працівники') }}</strong>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ІД</th>
                <th>Імя</th>
                <th>Телефон</th>
                <th>Посада</th>
                <th style="width: 0;" class="text-right"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->user_id }}</td>
                    <td>{{ $employee->user->name }} {{ $employee->user->lastname }}</td>
                    <td>{{ $employee->user->phone }}</td>
                    <td><label class="badge badge-primary">{{ $employee->position }}</label></td>
                    <td>
                        <a class="btn btn-sm btn-inverse icofont icofont-pencil-alt-2"
                           href="{{ route('user.edit', $employee->user_id) }}">
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>