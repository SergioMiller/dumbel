<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GymMembership\GymMembershipUpdateRequest;
use App\Repository\GymMembershipRepository;
use App\Services\Admin\GymMembershipService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class GymMembershipController extends Controller
{
    public function __construct(
        private readonly GymMembershipService $gymMembershipService,
        private readonly GymMembershipRepository $gymMembershipRepository
    ) {
    }

    public function edit(int $id): View
    {
        $model = $this->gymMembershipRepository->getById($id);

        abort_if(null === $model, 404);

        return view('admin.gym-membership.edit', ['membership' => $model]);
    }

    public function update(int $id, GymMembershipUpdateRequest $request): RedirectResponse
    {
        $model = $this->gymMembershipService->update($id, $request->validated());

        return redirect()->to(route('gym-membership.edit', $model->id))->with('success', 'Successfully.');
    }
}
