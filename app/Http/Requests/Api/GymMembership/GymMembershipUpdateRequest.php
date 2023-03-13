<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\GymMembership;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="GymMembershipUpdateRequest",
 *     type="object",
 *     required={"name", "day_quantity", "works_from", "works_to"},
 *
 *     @OA\Property(property="name", type="string", example="Unlimit"),
 *     @OA\Property(property="day_quantity", type="integer", example="12"),
 *     @OA\Property(property="works_from", type="integer", example="8"),
 *     @OA\Property(property="works_to", type="integer", example="21"),
 *     @OA\Property(property="training_quantity", type="integer", example="12"),
 *     @OA\Property(property="price", type="integer", example="800"),
 * )
 */
final class GymMembershipUpdateRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'day_quantity' => ['required', 'integer', 'max:31'],
            'works_from' => ['required', 'integer', 'min:0', 'max:24'],
            'works_to' => ['required', 'integer', 'min:0', 'max:24'],
            'training_quantity' => ['nullable', 'integer'],
            'price' => ['integer', 'nullable'],
        ];
    }
}
