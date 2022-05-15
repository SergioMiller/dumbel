<?php
declare(strict_types=1);

namespace App\Swagger\Request\Gym;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="RequestGymUpdate"
 *     )
 * )
 */
class RequestGymUpdate
{
    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $name;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $description;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $phone;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $email;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $address;
}
