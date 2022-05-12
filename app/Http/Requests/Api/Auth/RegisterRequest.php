<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'lastname' => ['string', 'required', 'max:255'],
            'phone' => ['required_without:email', 'nullable', 'max:24', Rule::unique('users', 'phone')],
            'email' => ['required_without:phone', 'nullable', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['string', 'required'],
            'device' => ['required', 'string'],
        ];
    }
}
