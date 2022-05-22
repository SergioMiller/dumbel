<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Gym;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManagerAddRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'gym_id' => [
                'required',
                'integer',
                Rule::exists('gyms', 'id')->where('user_id', $this->user()->id)
            ],
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
        ];
    }
}
