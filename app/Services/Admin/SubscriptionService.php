<?php
declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\Subscription;
use App\Repository\SubscriptionRepository;

class SubscriptionService
{
    private SubscriptionRepository $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function update(int $id, array $data): Subscription
    {
        return $this->subscriptionRepository->update($id, $data);
    }
}
