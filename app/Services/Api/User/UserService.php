<?php

declare(strict_types=1);

namespace App\Services\Api\User;

use App\Models\User;
use App\Models\UserSubscription;
use App\Repository\SubscriptionRepository;
use App\Repository\UserRepository;
use App\Services\Api\User\Dto\AttachSubscriptionDto;
use App\Services\Api\User\Dto\UserCreateDto;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly SubscriptionRepository $subscriptionRepository
    ) {
    }

    public function create(UserCreateDto $data): User
    {
        DB::beginTransaction();
        $user = new User($data->toArray());
        $user->save();
        #TODO:create client card

        DB::commit();

        return $user;
    }

    public function attachSubscription(User $administrator, AttachSubscriptionDto $data): UserSubscription
    {
        $user = $this->userRepository->getById($data->getUserId());

        if (null === $user) {
            throw new NotFoundHttpException('User not found.');
        }

        $subscription = $this->subscriptionRepository->getById($data->getSubscriptionId());

        if (null === $subscription) {
            throw new NotFoundHttpException('Subscription not found.');
        }

        $userSubscription = new UserSubscription();
        $userSubscription->user_id = $user->id;
        $userSubscription->gym_id = $subscription->gym_id;
        $userSubscription->administrator_id = $administrator->id;
        $userSubscription->name = $subscription->name;
        $userSubscription->day_quantity = $subscription->day_quantity;
        $userSubscription->works_from = $subscription->works_from;
        $userSubscription->works_to = $subscription->works_to;
        $userSubscription->training_quantity = $subscription->training_quantity;
        $userSubscription->price = $subscription->price;
        $userSubscription->created_at = Carbon::now()->toDateTimeString();

        $userSubscription->save();

        return $userSubscription;
    }
}
