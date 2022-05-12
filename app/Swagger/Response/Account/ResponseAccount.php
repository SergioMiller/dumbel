<?php
declare(strict_types=1);

namespace App\Swagger\Response\Account;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="ResponseAccount"
 *     )
 * )
 */
class ResponseAccount
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
}
