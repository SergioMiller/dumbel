<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\GymMembership;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="GymMembershipFreezeRequest",
 *     type="object",
 *     required={"user_gym_membership_id", "date_start", "date_end"},
 *
 *     @OA\Property(property="user_gym_membership_id", type="integer", example="1"),
 *     @OA\Property(property="date_start", type="string", format="datetime", example="10-10-2020"),
 *     @OA\Property(property="date_end", type="string", format="datetime", example="10-10-2020"),
 * )
 */
final class GymMembershipFreezeRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'user_gym_membership_id' => ['required', 'integer', Rule::exists('user_gym_memberships', 'id')],
            'date_start' => ['required', 'date', 'before_or_equal:date_end'],
            'date_end' => ['required', 'date', 'after_or_equal:start_date'],
        ];
    }
}
