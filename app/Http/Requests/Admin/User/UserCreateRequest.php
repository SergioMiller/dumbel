<?php
declare(strict_types=1);

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'email' => ['email', 'required', 'max:255', Rule::unique('users', 'email')],
            'status' => ['string', Rule::in('active', 'blocked')],
            'password' => ['string', 'required'],
        ];
    }
}
