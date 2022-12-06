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
    private SubscriptionService $subscriptionService;

    private SubscriptionRepository $subscriptionRepository;

    public function __construct(
        SubscriptionService $subscriptionService,
        SubscriptionRepository $subscriptionRepository
    ) {
        $this->subscriptionService = $subscriptionService;
        $this->subscriptionRepository = $subscriptionRepository;
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
