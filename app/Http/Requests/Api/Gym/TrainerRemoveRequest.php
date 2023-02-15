<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Gym;

use App\Library\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TrainerRemoveRequest",
 *     type="object",
 *     required={"name", "address"},
 *     @OA\Property(property="gym_id", type="integer", example="1"),
 *     @OA\Property(property="user_id", type="integer", example="1"),
 * )
 */
final class TrainerRemoveRequest extends FormRequest
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
