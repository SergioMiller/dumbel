<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RegisterCheckQrCodeRequest",
 *     type="object",
 *     required={"uuid"},
 *
 *     @OA\Property(property="uuid", type="string", format="uuid", example="3fa85f64-5717-4562-b3fc-2c963f66afa6"),
 * )
 */
final class RegisterCheckQrCodeRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'uuid' => ['required', 'uuid'],
        ];
    }
}
