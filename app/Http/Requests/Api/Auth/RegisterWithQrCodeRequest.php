<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterWithQrCodeRequest extends FormRequest
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
                'max:24',
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
