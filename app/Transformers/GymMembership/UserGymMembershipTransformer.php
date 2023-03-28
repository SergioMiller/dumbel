<?php

declare(strict_types=1);

namespace App\Transformers\GymMembership;

use App\Library\Transformer;
use App\Models\UserGymMembership;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="UserGymMembershipTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="user_id", type="integer", example="1"),
 * @OA\Property(property="gym_id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Gym membership name"),
 * @OA\Property(property="day_quantity", type="integer", example="35"),
 * @OA\Property(property="freeze_day_quantity", type="integer", example="7"),
 * @OA\Property(property="works_from", type="integer", example="8"),
 * @OA\Property(property="works_to", type="integer", example="21"),
 * @OA\Property(property="training_quantity", type="integer", example="12"),
 * @OA\Property(property="price", type="integer", example="720"),
 * @OA\Property(property="status", type="string", example="active"),
 * @OA\Property(property="date_start", type="string", format="datetime", example="2023-12-31"),
 * @OA\Property(property="date_end", type="string", format="datetime", example="2023-12-31"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 * @OA\Property(property="freezes", type="array", @OA\Items(ref="#/components/schemas/UserGymMembershipFreezeTransformer")),
 */
class UserGymMembershipTransformer extends Transformer
{
    public function toArray(UserGymMembership $model): array
    {
        return [
            'id' => $model->id,
            'user_id' => $model->user_id,
            'gym_id' => $model->gym_id,
            'gym_membership_id' => $model->gym_membership_id,
            'name' => $model->name,
            'day_quantity' => $model->day_quantity,
            'freeze_day_quantity' => $model->freeze_day_quantity,
            'works_from' => $model->works_from,
            'works_to' => $model->works_to,
            'training_quantity' => $model->training_quantity,
            'price' => $model->price,
            'status' => $model->status,
            'date_start' => $model->date_start,
            'date_end' => $model->date_end,
            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString(),
            'freezes' => new UserGymMembershipFreezeTransformer($model->freezes)
        ];
    }
}
