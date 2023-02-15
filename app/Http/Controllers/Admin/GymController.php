<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Filters\Admin\GymFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gym\GymCreateRequest;
use App\Http\Requests\Admin\Gym\GymUpdateRequest;
use App\Models\Gym;
use App\Models\User;
use App\Tables\GymTable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class GymController extends Controller
{
    public function index(Request $request): View
    {
        $table = (new GymTable($request->query()))
            ->setFilter(GymFilter::class)
            ->setTitle('Спортивні зали')
            ->setCreateUrl(route('gym.create'));

        return view('admin.table', [
            'table' => $table,
            'paginator' => $table->paginator(),
            'attributes' => $table->attributes()
        ]);
    }

    public function create(): View
    {
        return view('admin.gym.create', [
            'users' => User::query()->orderBy('name')->get()
        ]);
    }

    public function store(GymCreateRequest $request): RedirectResponse
    {
        $model = new Gym($request->validated());

        $model->save();

        return redirect()->to(route('gym.edit', $model->id))->with('success', 'Successfully.');
    }

    public function edit(int $id): View
    {
        $model = Gym::query()->where('id', $id)->first();

        abort_if(null === $model, 404);

        return view('admin.gym.edit', [
            'gym' => $model,
            'users' => User::query()->get()
        ]);
    }

    public function update(int $id, GymUpdateRequest $request): RedirectResponse
    {
        $model = Gym::query()->where('id', $id)->first();

        abort_if(null === $model, 404);

        $model->update($request->validated());

        return redirect()->to(route('gym.edit', $model->id))->with('success', 'Successfully.');
    }

    public function destroy($id)
    {
    }
}
