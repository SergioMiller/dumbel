<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Library\Response;
use Exception;
use Illuminate\Http\JsonResponse;

class ResponsableException extends Exception
{
    public function render($request): JsonResponse
    {
        return Response::error(['message' => $this->message ?? null], $this->code);
    }
}
