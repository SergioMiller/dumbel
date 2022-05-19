<?php
declare(strict_types=1);

namespace App\Swagger\Request\Gym;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="RequestGymTrainerRemove"
 *     )
 * )
 */
class RequestGymTrainerRemove
{
    /**
     * @OA\Property()
     *
     * @var int
     */
    private int $gym_id;

    /**
     * @OA\Property()
     *
     * @var int
     */
    private int $user_id;
}
