<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gym\GymCreateRequest;
use App\Http\Requests\Admin\Gym\GymUpdateRequest;
use App\Models\Gym;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class GymController extends Controller
{
    public function index(): Factory | View | Application
    {
        return view('admin.gym.index', [
            'gyms' => Gym::query()->with('user')->orderByDesc('id')->paginate()
        ]);
    }

    public function create(): Factory | View | Application
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

    public function edit(int $id): Factory | View | Application
    {
        $model = Gym::query()->where('id', $id)->first();

        abort_if($model === null, 404);

        return view('admin.gym.edit', [
            'gym' => $model,
            'users' => User::query()->get()
        ]);
    }

    public function update(int $id, GymUpdateRequest $request): RedirectResponse
    {
        $model = Gym::query()->where('id', $id)->first();

        abort_if($model === null, 404);

        $model->update($request->validated());

        return redirect()->to(route('gym.edit', $model->id))->with('success', 'Successfully.');
    }

    public function destroy($id)
    {
    }
}