<?php
declare(strict_types=1);

namespace App\Swagger\Request\Auth;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="RequestPasswordResetConfirm"
 *     )
 * )
 */
class RequestPasswordResetConfirm
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

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $password_conformation;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $code;
}
