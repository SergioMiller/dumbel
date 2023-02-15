<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

use App\Library\FailedValidation;
use App\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RegisterWithQrCodeRequest",
 *     type="object",
 *     required={"phone", "name", "lastname"},
 *     @OA\Property(property="name", type="string", example="Joh"),
 *     @OA\Property(property="lastname", type="string", example="Dou"),
 *     @OA\Property(property="phone", type="integer", example="380987654321"),
 *     @OA\Property(property="email", type="string", format="email", example="email@email.email"),
 *     @OA\Property(property="password", type="string", example="password"),
 *     @OA\Property(property="birthday", type="string", format="date", example="10-10-2020"),
 *     @OA\Property(property="device", type="string", example="Nokia6230i/2.0 (03.25) Profile/MIDP-2.0 Configuration/CLDC-1.1"),
 * )
 */
final class RegisterWithQrCodeRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'lastname' => ['string', 'required', 'max:255'],
            'phone' => [
                'required',
                'nullable',
                new PhoneNumberRule,
                Rule::unique('users', 'phone')
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')
            ],
            'password' => ['string', 'required'],
            'birthday' => ['date', 'before:today', 'nullable'],
            'device' => ['required', 'string'],
        ];
    }
}
