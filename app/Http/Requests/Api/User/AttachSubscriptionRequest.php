<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\User;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="AttachSubscribeRequest",
 *     type="object",
 *     required={"user_id", "subscription_id"},
 *
 *     @OA\Property(property="user_id", type="integer", example="1"),
 *     @OA\Property(property="subscription_id", type="integer", example="1"),
 * )
 */
final class AttachSubscriptionRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer'],
            'subscription_id' => ['required', 'integer'],
        ];
    }
}
