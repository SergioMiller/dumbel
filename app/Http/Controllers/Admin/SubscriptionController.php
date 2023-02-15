<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Subscription\SubscriptionUpdateRequest;
use App\Repository\SubscriptionRepository;
use App\Services\Admin\SubscriptionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class SubscriptionController extends Controller
{
    public function __construct(
        private readonly SubscriptionService $subscriptionService,
        private readonly SubscriptionRepository $subscriptionRepository
    ) {
    }

    public function edit(int $id): View
    {
        $model = $this->subscriptionRepository->getById($id);

        abort_if(null === $model, 404);

        return view('admin.subscription.edit', ['subscription' => $model]);
    }

    public function update(int $id, SubscriptionUpdateRequest $request): RedirectResponse
    {
        $model = $this->subscriptionService->update($id, $request->validated());

        return redirect()->to(route('subscription.edit', $model->id))->with('success', 'Successfully.');
    }
}
