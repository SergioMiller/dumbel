<?php
declare(strict_types=1);

namespace App\Http\Requests\Admin\Gym;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GymUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'int', Rule::exists('users', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:512'],
            'phone' => ['nullable', 'string', 'max:24'],
            'email' => ['nullable', 'email', 'max:512'],
            'address' => ['required', 'string', 'max:512'],
        ];
    }
}
