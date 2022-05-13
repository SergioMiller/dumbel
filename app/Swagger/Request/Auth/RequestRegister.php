<?php
declare(strict_types=1);

namespace App\Swagger\Request\Auth;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="RequestRegister"
 *     )
 * )
 */
class RequestRegister
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
    private string $password;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $device;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $uuid;
}
