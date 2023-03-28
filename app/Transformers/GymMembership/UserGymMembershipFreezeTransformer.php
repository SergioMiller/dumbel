<?php

declare(strict_types=1);

namespace App\Transformers\GymMembership;

use App\Library\Transformer;
use App\Models\UserGymMembershipFreeze;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="UserGymMembershipFreezeTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="day_quantity", type="integer", example="1"),
 * @OA\Property(property="date_start", type="string", format="datetime", example="2023-12-31"),
 * @OA\Property(property="date_end", type="string", format="datetime", example="2023-12-31"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 */
class UserGymMembershipFreezeTransformer extends Transformer
{
    public function toArray(UserGymMembershipFreeze $model): array
    {
        return [
            'id' => $model->id,
            'day_quantity' => $model->day_quantity,
            'date_start' => $model->date_start,
            'date_end' => $model->date_end,
            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString(),
        ];
    }
}
