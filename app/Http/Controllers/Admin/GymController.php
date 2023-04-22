<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Filters\Admin\GymFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gym\GymCreateRequest;
use App\Http\Requests\Admin\Gym\GymUpdateRequest;
use App\Models\Gym;
use App\Models\GymMembership;
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
        $entity = new Gym($request->validated());

        $entity->save();

        return redirect()->to(route('gym.edit', $entity->id))->with('success', 'Successfully.');
    }

    public function edit(int $id): View
    {
        /** @var Gym $entity */
        $entity = Gym::query()->where('id', $id)->first();

        abort_if(null === $entity, 404);

        return view('admin.gym.edit', [
            'gym' => $entity,
            'memberships' => GymMembership::query()->where('gym_id', $entity->id)->paginate(5),
            'users' => User::query()->get()
        ]);
    }

    public function update(int $id, GymUpdateRequest $request): RedirectResponse
    {
        $entity = Gym::query()->where('id', $id)->first();

        abort_if(null === $entity, 404);

        $entity->update($request->validated());

        return redirect()->to(route('gym.edit', $entity->id))->with('success', 'Successfully.');
    }

    public function destroy($id)
    {
    }
}
