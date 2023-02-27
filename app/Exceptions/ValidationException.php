<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Library\Response;
use Illuminate\Http\JsonResponse;

class ValidationException extends ResponsableException
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;

        parent::__construct('The given data was invalid.', 422);
    }

    public function render($request): JsonResponse
    {
        return Response::error([
            'message' => $this->message,
            'data' => $this->data
        ], $this->code);
    }
}
