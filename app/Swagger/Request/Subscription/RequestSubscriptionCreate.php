<?php
declare(strict_types=1);

namespace App\Swagger\Request\Subscription;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="RequestSubscriptionCreate"
 *     )
 * )
 */
class RequestSubscriptionCreate
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
     * @var string
     */
    private string $name;

    /**
     * @OA\Property()
     *
     * @var int
     */
    private int $day_quantity;

    /**
     * @OA\Property()
     *
     * @var int
     */
    private int $works_from;

    /**
     * @OA\Property()
     *
     * @var int
     */
    private int $works_to;

    /**
     * @OA\Property()
     *
     * @var int
     */
    private int $training_quantity;

    /**
     * @OA\Property()
     *
     * @var int
     */
    private int $price;
}
