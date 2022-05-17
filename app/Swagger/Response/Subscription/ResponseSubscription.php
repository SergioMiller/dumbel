<?php
declare(strict_types=1);

namespace App\Swagger\Response\Subscription;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="ResponseSubscription"
 *     )
 * )
 */
class ResponseSubscription
{
    /**
     * @OA\Property()
     *
     * @var int
     */
    private int $id;

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

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $created_at;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $updated_at;
}
