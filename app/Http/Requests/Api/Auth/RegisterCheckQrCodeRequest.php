<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class RegisterCheckQrCodeRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'uuid' => ['required', 'uuid'],
        ];
    }
}
