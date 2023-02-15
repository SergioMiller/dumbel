<?php
declare(strict_types=1);

namespace App\Swagger\Response;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     @OA\Xml(
 *         name="Response"
 *     )
 * )
 */
class Response
{
    /**
     * @OA\Property()
     *
     * @var boolean
     */
    private bool $success;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private string $message;

    /**
     * @OA\Property()
     *
     * @var object
     */
    private object $meta;

    /**
     * @OA\Property()
     *
     * @var object
     */
    private object $data;
}
