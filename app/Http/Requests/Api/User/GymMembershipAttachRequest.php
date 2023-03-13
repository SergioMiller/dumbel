<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\User;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="GymMembershipAttachRequest",
 *     type="object",
 *     required={"user_id", "gym_membership_id"},
 *
 *     @OA\Property(property="user_id", type="integer", example="1"),
 *     @OA\Property(property="gym_membership_id", type="integer", example="1"),
 * )
 */
final class GymMembershipAttachRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer'],
            'gym_membership_id' => ['required', 'integer'],
        ];
    }
}
