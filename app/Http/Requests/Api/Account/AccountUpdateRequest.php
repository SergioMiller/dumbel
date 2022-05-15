<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Account;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountUpdateRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'lastname' => ['string', 'required', 'max:255'],
            'phone' => [
                'required_without:email',
                'nullable',
                'max:24',
                Rule::unique('users', 'phone')->ignore($this->user()->id)
            ],
            'email' => [
                'required_without:phone',
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()->id)
            ],
            'password' => ['string', 'required'],
            'birthday' => ['date', 'before:today', 'required'],
        ];
    }
}
