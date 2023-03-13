<div class="card">
    <div class="card-footer vertical-middle">
        <strong>{{ 'Абонемент' }}</strong>
        <div class="float-right">
            <a class="" href="{{ route('gym-membership.edit', $gymMembership->id) }}">
                Редагувати
            </a>
            <a class="text-danger" href="{{ route('gym-membership.edit', $gymMembership->id) }}">
                Видалити
            </a>
        </div>
    </div>
    <table class="table table-sm">
        <tr>
            <td>Назва</td>
            <td>{{ $gymMembership->name }}</td>
        </tr>
        <tr>
            <td>Кількість днів</td>
            <td>{{ $gymMembership->day_quantity }}</td>
        </tr>
        <tr>
            <td>Заморозка для карти в днях</td>
            <td>{{ $gymMembership->freeze_day_quantity }}</td>
        </tr>
        <tr>
            <td>Активний, з - до</td>
            <td>{{ $gymMembership->works_from }} - {{ $gymMembership->works_to }}</td>
        </tr>
        <tr>
            <td>Кількість тренувань</td>
            <td>{{ $gymMembership->training_quantity }}</td>
        </tr>
        <tr>
            <td>Ціна</td>
            <td><strong>{{ $gymMembership->price }}</strong>@isset($gymMembership->price)грн.@endisset</td>
        </tr>
        <tr>
            <td>Створено</td>
            <td>{{ $gymMembership->created_at }}</td>
        </tr>
        <tr>
            <td>Відредаговано</td>
            <td>{{ $gymMembership->updated_at }}</td>
        <tr>
    </table>
</div>