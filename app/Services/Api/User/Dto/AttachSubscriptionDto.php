<?php

declare(strict_types=1);

namespace App\Services\Api\User\Dto;

use Illuminate\Contracts\Support\Arrayable;

final class AttachSubscriptionDto implements Arrayable
{
    private readonly int $user_id;

    private readonly int $subscription_id;

    public static function fromArray(array $data): self
    {
        $instance = new  self();
        $instance->user_id = $data['user_id'];
        $instance->subscription_id = $data['subscription_id'];

        return $instance;
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'subscription_id' => $this->subscription_id,
        ];
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getSubscriptionId(): int
    {
        return $this->subscription_id;
    }
}
