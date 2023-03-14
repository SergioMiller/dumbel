<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

class FreezeDaysAvailableLimitExceededException extends ResponsableException
{
    public function __construct($message = 'Freeze days available limit exceeded.', $code = 422, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
