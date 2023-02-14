<?php
declare(strict_types=1);

namespace App\Http\Requests\Admin\User;

use App\Enums\UserStatusEnum;
use App\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'lastname' => ['string', 'required', 'max:255'],
            'phone' => ['required', 'nullable', new PhoneNumberRule, Rule::unique('users', 'phone')->ignore($this->id)],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->id)],
            'status' => ['string', Rule::in(UserStatusEnum::values())],
            'birthday' => ['date', 'before:today', 'nullable'],
            'password' => ['string', 'nullable'],
        ];
    }
}
