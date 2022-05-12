<?php
declare(strict_types=1);

namespace App\Library;

class ResponseFactory extends \Illuminate\Routing\ResponseFactory
{
    public function json($data = [], $status = 200, array $headers = [], $options = 0)
    {
        return new JsonResponse($data, $status, $headers, $options);
    }
}
