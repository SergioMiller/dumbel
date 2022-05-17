<div class="card">
    <table class="table table-sm">
        <tr>
            <td>Id</td>
            <td>{{ $subscription->id }}</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{ $subscription->name }}</td>
        </tr>
        <tr>
            <td>Day quantity</td>
            <td>{{ $subscription->day_quantity }}</td>
        </tr>
        <tr>
            <td>Works from</td>
            <td>{{ $subscription->works_from }}</td>
        </tr>
        <tr>
            <td>Works to</td>
            <td>{{ $subscription->works_to }}</td>
        </tr>
        <tr>
            <td>Training quantity</td>
            <td>{{ $subscription->idtraining_quantity }}</td>
        </tr>
        <tr>
            <td>Price</td>
            <td>{{ $subscription->price }}</td>
        </tr>
        <tr>
            <td>Created at</td>
            <td>{{ $subscription->created_at }}</td>
        </tr>
        <tr>
            <td>Updated at</td>
            <td>{{ $subscription->updated_at }}</td>
        <tr>
    </table>
</div>