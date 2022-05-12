<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'max:24'],
            'password' => ['required', 'string', 'min:6'],
            'device' => ['required', 'string'],
        ];
    }
}
