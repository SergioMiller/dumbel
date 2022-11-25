<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Filters\Admin\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserCreateRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Models\User;
use App\Tables\UserTable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $table = (new UserTable($request->query()))->setFilter(UserFilter::class);

        return view('admin.table', [
            'table' => $table,
            'attributes' => $table->attributes()
        ]);
    }

    public function create(): View
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

    public function edit(int $id): View
    {
        $model = User::query()->where('id', $id)->first();

        abort_if(null === $model, 404);

        return view('admin.user.edit', ['user' => $model]);
    }

    public function update(int $id, UserUpdateRequest $request): RedirectResponse
    {
        $model = User::query()->where('id', $id)->first();

        abort_if(null === $model, 404);

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
