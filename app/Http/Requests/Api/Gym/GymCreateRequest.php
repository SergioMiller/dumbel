<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Gym;

use App\Library\FailedValidation;
use App\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="GymCreateRequest",
 *     type="object",
 *     required={"name", "address"},
 *     @OA\Property(property="name", type="string", example="Joh"),
 *     @OA\Property(property="description", type="string", example="The best gym."),
 *     @OA\Property(property="phone", type="integer", example="380987654321"),
 *     @OA\Property(property="email", type="string", format="email", example="email@email.email"),
 *     @OA\Property(property="address", type="string", example="Cecelia Havens, 456 White Finch St.,North Augusta, SC 29860"),
 * )
 */
final class GymCreateRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:512'],
            'phone' => ['nullable', 'integer', new PhoneNumberRule],
            'email' => ['nullable', 'email', 'max:512'],
            'address' => ['required', 'string', 'max:512'],
        ];
    }
}
