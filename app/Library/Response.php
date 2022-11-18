<?php
declare(strict_types=1);

namespace App\Library;

use Illuminate\Http\JsonResponse;

abstract class Response
{
    public static function success($data = [], array $meta = [], int $code = 200): JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'message' => null,
            'meta' => $meta,
            'data' => $data,
        ], $code);
    }

    public static function error(array $data = [], int $code = 500): JsonResponse
    {
        return new JsonResponse([
            'success' => false,
            'message' => $data['message'] ?? null,
            'meta' => $data['meta'] ?? [],
            'data' => $data['data'] ?? []
        ], $code);
    }
}
