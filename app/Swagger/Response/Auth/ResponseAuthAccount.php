<?php
declare(strict_types=1);

namespace App\Swagger\Response\Auth;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="ResponseAuthAccount"
 *     )
 * )
 */
class ResponseAuthAccount
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
    private string $birthday;
}
