<?php
declare(strict_types=1);

namespace App\Http\Requests\Admin\User;

use App\Constants\UserStatusConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'lastname' => ['string', 'required', 'max:255'],
            'phone' => ['required_without:email', 'nullable', 'max:24', Rule::unique('users', 'phone')->ignore($this->id)],
            'email' => ['required_without:phone', 'nullable', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->id)],
            'status' => ['string', Rule::in(UserStatusConstant::getConstants())],
            'birthday' => ['date', 'nullable'],
            'password' => ['string', 'nullable'],
        ];
    }
}
