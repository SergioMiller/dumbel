<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\GymMembership;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="GymMembershipCreateRequest",
 *     type="object",
 *     required={"gym_id", "name", "day_quantity", "works_from", "works_to"},
 *
 *     @OA\Property(property="gym_id", type="integer", example="1"),
 *     @OA\Property(property="name", type="string", example="Unlimit"),
 *     @OA\Property(property="day_quantity", type="integer", example="31"),
 *     @OA\Property(property="freeze_day_quantity", type="integer", example="7"),
 *     @OA\Property(property="works_from", type="integer", example="8"),
 *     @OA\Property(property="works_to", type="integer", example="21"),
 *     @OA\Property(property="training_quantity", type="integer", example="12"),
 *     @OA\Property(property="price", type="integer", example="800"),
 * )
 */
final class GymMembershipCreateRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'gym_id' => [
                'required',
                'integer',
                Rule::exists('gyms', 'id')->where('user_id', $this->user()->id)
            ],
            'name' => ['required', 'string', 'max:255'],
            'day_quantity' => ['required', 'integer'],
            'freeze_day_quantity' => ['nullable', 'integer', 'lt:day_quantity'],
            'works_from' => ['required', 'integer', 'min:0', 'max:24'],
            'works_to' => ['required', 'integer', 'min:0', 'max:24'],
            'training_quantity' => ['nullable', 'integer'],
            'price' => ['integer', 'nullable'],
        ];
    }
}