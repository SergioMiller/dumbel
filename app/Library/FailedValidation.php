<?php

declare(strict_types=1);

namespace App\Library;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FailedValidation
{
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(Response::error([
            'message' => 'The given data was invalid.',
            'data' => $validator->errors()->messages()
        ], 422));
    }
}
