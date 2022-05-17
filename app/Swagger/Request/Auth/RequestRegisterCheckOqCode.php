<?php
declare(strict_types=1);

namespace App\Swagger\Request\Auth;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="RequestRegisterCheckOqCode"
 *     )
 * )
 */
class RequestRegisterCheckOqCode
{
    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $uuid;
}
