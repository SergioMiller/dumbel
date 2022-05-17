<?php
declare(strict_types=1);

namespace App\Swagger\Response\Auth;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="ResponseRegisterCheckQrCode"
 *     )
 * )
 */
class ResponseRegisterCheckQrCode
{
    /**
     * @OA\Property()
     *
     * @var bool
     */
    private bool $result;
}
