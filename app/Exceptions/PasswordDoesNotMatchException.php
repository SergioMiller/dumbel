<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

class PasswordDoesNotMatchException extends ResponsableException
{
    public function __construct($message = 'Password does not match.', $code = 422, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
