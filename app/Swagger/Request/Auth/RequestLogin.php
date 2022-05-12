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
    private string $email;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $password;
}
