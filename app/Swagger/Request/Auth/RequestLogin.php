<?php
declare(strict_types=1);

namespace App\Swagger\Request\Auth;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="RequestLogin"
 *     )
 * )
 */
class RequestLogin
{
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
    private string $password;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $device;
}
