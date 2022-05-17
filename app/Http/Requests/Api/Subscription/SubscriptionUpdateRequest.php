<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Subscription;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionUpdateRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'day_quantity' => ['required', 'integer', 'max:31'],
            'works_from' => ['required', 'integer', 'min:0', 'max:24'],
            'works_to' => ['required', 'integer', 'min:0', 'max:24'],
            'training_quantity' => ['nullable', 'integer'],
            'price' => ['integer', 'nullable'],
        ];
    }
}
