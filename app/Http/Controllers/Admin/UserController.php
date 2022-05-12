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
        $user = new User($data);

        $user->save();

        return redirect()->to(route('user.edit', $user->id))->with('success', 'Successfully.');
    }

    public function edit(int $id): Factory | View | Application
    {
        $user = User::query()->where('id', $id)->first();

        abort_if($user === null, 404);

        return view('admin.user.edit', ['user' => $user]);
    }

    public function update(int $id, UserUpdateRequest $request): RedirectResponse
    {
        $user = User::query()->where('id', $id)->first();

        abort_if($user === null, 404);

        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->to(route('user.edit', $user->id))->with('success', 'Successfully.');
    }

    public function destroy($id)
    {
    }
}
