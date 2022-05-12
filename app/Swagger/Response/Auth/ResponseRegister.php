<?php
declare(strict_types=1);

namespace App\Swagger\Response\Auth;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="ResponseRegister"
 *     )
 * )
 */
class ResponseRegister
{
    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $token;
}
