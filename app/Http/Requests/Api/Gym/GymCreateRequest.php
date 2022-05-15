<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Gym;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class GymCreateRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:512'],
            'phone' => ['nullable', 'string', 'max:24'],
            'email' => ['nullable', 'email', 'max:512'],
            'address' => ['required', 'string', 'max:512'],
        ];
    }
}
