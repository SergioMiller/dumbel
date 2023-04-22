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
        $entity = $this->gymMembershipRepository->getById($id);

        abort_if(null === $entity, 404);

        return view('admin.gym-membership.edit', ['membership' => $entity]);
    }

    public function update(int $id, GymMembershipUpdateRequest $request): RedirectResponse
    {
        $entity = $this->gymMembershipService->update($id, $request->validated());

        return redirect()->to(route('gym-membership.edit', $entity->id))->with('success', 'Successfully.');
    }
}
