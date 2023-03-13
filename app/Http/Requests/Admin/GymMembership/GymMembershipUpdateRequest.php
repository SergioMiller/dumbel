<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\GymMembership;

use Illuminate\Foundation\Http\FormRequest;

final class GymMembershipUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'day_quantity' => ['nullable', 'integer', 'max:365'],
            'works_from' => ['required', 'integer', 'min:0', 'max:24'],
            'works_to' => ['required', 'integer', 'min:0', 'max:24', 'gt:works_from'],
            'training_quantity' => ['nullable', 'integer'],
            'price' => ['required', 'integer'],
        ];
    }
}
