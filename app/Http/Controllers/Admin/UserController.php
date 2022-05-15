<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserCreateRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): Factory | View | Application
    {
        return view('admin.user.index', [
            'users' => User::query()->orderByDesc('id')->paginate()
        ]);
    }

    public function create(): Factory | View | Application
    {
        return view('admin.user.create');
    }

    public function store(UserCreateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $model = new User($data);

        $model->save();

        return redirect()->to(route('user.edit', $model->id))->with('success', 'Successfully.');
    }

    public function edit(int $id): Factory | View | Application
    {
        $model = User::query()->where('id', $id)->first();

        abort_if($model === null, 404);

        return view('admin.user.edit', ['user' => $model]);
    }

    public function update(int $id, UserUpdateRequest $request): RedirectResponse
    {
        $model = User::query()->where('id', $id)->first();

        abort_if($model === null, 404);

        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $model->update($data);

        return redirect()->to(route('user.edit', $model->id))->with('success', 'Successfully.');
    }

    public function destroy($id)
    {
    }
}
