<div class="card">
    <div class="card-footer vertical-middle">
        <strong>{{ 'Абонемент' }}</strong>
        <a class="btn btn-sm btn-inverse icofont icofont-pencil-alt-2 float-right"
           href="{{ route('subscription.edit', $subscription->id) }}">
        </a>
    </div>
    <table class="table table-sm">
        <tr>
            <td>Назва</td>
            <td>{{ $subscription->name }}</td>
        </tr>
        <tr>
            <td>Кількість днів</td>
            <td>{{ $subscription->day_quantity }}</td>
        </tr>
        <tr>
            <td>Активний, з - до</td>
            <td>{{ $subscription->works_from }} - {{ $subscription->works_to }}</td>
        </tr>
        <tr>
            <td>Кількість тренувань</td>
            <td>{{ $subscription->training_quantity }}</td>
        </tr>
        <tr>
            <td>Ціна</td>
            <td><strong>{{ $subscription->price }}</strong>@isset($subscription->price)грн.@endisset</td>
        </tr>
        <tr>
            <td>Створено</td>
            <td>{{ $subscription->created_at }}</td>
        </tr>
        <tr>
            <td>Відредаговано</td>
            <td>{{ $subscription->updated_at }}</td>
        <tr>
    </table>
</div>