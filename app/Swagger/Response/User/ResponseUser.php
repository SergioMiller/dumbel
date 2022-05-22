<?php
declare(strict_types=1);

namespace App\Swagger\Response\User;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="ResponseUser"
 *     )
 * )
 */
class ResponseUser
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
     * @var string
     */
    private string $name;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $lastname;

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
    private string $birthday;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $uuid;
}
