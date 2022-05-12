<?php
declare(strict_types=1);

namespace App\Swagger\Request\Auth;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="RequestPasswordReset"
 *     )
 * )
 */
class RequestPasswordReset
{
    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $email;
}
