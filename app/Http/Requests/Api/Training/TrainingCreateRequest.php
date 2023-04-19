<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Training;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TrainingCreateRequest",
 *     type="object",
 *     required={"user_id"},
 *
 *     @OA\Property(property="user_id", type="integer", example="1"),
 *     @OA\Property(property="gym_membership_id", type="integer", example="1"),
 *     @OA\Property(property="trainer_id", type="integer", example="1"),
 *     @OA\Property(property="started_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 *     @OA\Property(property="locker_number", type="integer", example="1"),
 * )
 */
final class TrainingCreateRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'gym_membership_id' => ['nullable', 'integer', Rule::exists('user_gym_memberships', 'id')],
            'trainer_id' => ['nullable', 'integer', Rule::exists('users', 'id')],
            'started_at' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'locker_number' => ['nullable', 'integer'],
        ];
    }
}
