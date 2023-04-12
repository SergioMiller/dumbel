<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Gym;

use App\Enums\GymEmployeePositionEnum;
use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="GymEmployeeRemoveRequest",
 *     type="object",
 *     required={"user_id", "position"},
 *
 *     @OA\Property(property="user_id", type="integer", example="1"),
 *     @OA\Property(property="position", type="string", example="trainer"),
 * )
 */
final class GymEmployeeRemoveRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'position' => ['required', 'string', Rule::in(GymEmployeePositionEnum::values())],
        ];
    }
}
