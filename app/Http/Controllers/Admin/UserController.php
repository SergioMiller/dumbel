<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Filters\Admin\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserCreateRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Repository\UserRepository;
use App\Services\Admin\UserService;
use App\Tables\UserTable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class UserController extends Controller
{
    public function __construct(private readonly UserService $userService, private readonly UserRepository $userRepository)
    {
    }

    public function index(Request $request): View
    {
        $table = (new UserTable($request->query()))
            ->setFilter(UserFilter::class)
            ->setTitle('Користувачі')
            ->setCreateUrl(route('user.create'));

        return view('admin.table', [
            'table' => $table,
            'paginator' => $table->paginator(),
            'attributes' => $table->attributes()
        ]);
    }

    public function create(): View
    {
        return view('admin.user.create');
    }

    public function store(UserCreateRequest $request): RedirectResponse
    {
        $model = $this->userService->store($request->validated());

        return redirect()->to(route('user.edit', $model->id))->with('success', 'Successfully.');
    }

    public function edit(int $id): View
    {
        $model = $this->userRepository->getById($id);

        abort_if(null === $model, 404);

        return view('admin.user.edit', ['user' => $model]);
    }

    public function update(int $id, UserUpdateRequest $request): RedirectResponse
    {
        $model = $this->userService->update($id, $request->validated());

        return redirect()->to(route('user.edit', $model->id))->with('success', 'Successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $model = $this->userRepository->getById($id);

        abort_if(null === $model, 404);

        return redirect()->to(route('user.index'))->with('success', 'Successfully.');
    }
}
