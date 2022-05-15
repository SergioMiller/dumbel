<?php
declare(strict_types=1);

namespace App\Swagger\Request\Account;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="RequestAccountUpdate"
 *     )
 * )
 */
class RequestAccountUpdate
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

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $password;
}
