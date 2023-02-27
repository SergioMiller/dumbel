<?php

declare(strict_types=1);

namespace App\Library;

use Illuminate\Routing\ResponseFactory as BaseFactoryAlias;

class ResponseFactory extends BaseFactoryAlias
{
    public function json($data = [], $status = 200, array $headers = [], $options = 0): JsonResponse
    {
        return new JsonResponse($data, $status, $headers, $options);
    }
}
