<?php
declare(strict_types=1);

namespace App\Swagger\Response\Gym;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="ResponseGym"
 *     )
 * )
 */
class ResponseGym
{
    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $id;

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
