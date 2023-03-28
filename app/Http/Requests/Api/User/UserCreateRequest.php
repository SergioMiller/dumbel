<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\User;

use App\Library\FailedValidation;
use App\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="UserCreateRequest",
 *     type="object",
 *     required={"phone", "name", "lastname"},
 *
 *     @OA\Property(property="name", type="string", example="Joh"),
 *     @OA\Property(property="lastname", type="string", example="Dou"),
 *     @OA\Property(property="phone", type="integer", example="380987654321"),
 *     @OA\Property(property="email", type="string", format="email", example="email@email.email"),
 *     @OA\Property(property="birthday", type="string", format="date", example="2023-12-31"),
 * )
 */
final class UserCreateRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'lastname' => ['string', 'required', 'max:255'],
            'phone' => ['nullable', 'integer', new PhoneNumberRule(), Rule::unique('users', 'phone')],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')],
            'birthday' => ['date', 'before:today', 'nullable'],
        ];
    }
}
