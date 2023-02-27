<div class="card">
    <div class="card-footer">
        <strong>{{ __('Менеджери') }}</strong>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ІД</th>
                <th>Імя</th>
                <th>Телефон</th>
                <th style="width: 0;" class="text-right"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($managers as $manager)
                <tr>
                    <td>{{ $manager->id }}</td>
                    <td>{{ $manager->name }} {{ $manager->lastname }}</td>
                    <td>{{ $manager->phone }}</td>
                    <td>
                        <a class="btn btn-sm btn-inverse icofont icofont-pencil-alt-2"
                           href="{{ route('user.edit', $manager->id) }}">
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>