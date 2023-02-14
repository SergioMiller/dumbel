<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

use App\Library\FailedValidation;
use App\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="LoginRequest",
 *     type="object",
 *     required={"phone", "name", "lastname"},
 *     @OA\Property(property="phone", type="integer", example="380987654321"),
 *     @OA\Property(property="password", type="string", example="password"),
 *     @OA\Property(property="device", type="string", example="Nokia6230i/2.0 (03.25) Profile/MIDP-2.0 Configuration/CLDC-1.1"),
 * )
 */
class LoginRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'phone' => ['required', 'integer', new PhoneNumberRule],
            'password' => ['required', 'string', 'min:6'],
            'device' => ['required', 'string'],
        ];
    }
}
