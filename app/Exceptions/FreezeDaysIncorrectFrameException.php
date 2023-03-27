<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

class FreezeDaysIncorrectFrameException extends ResponsableException
{
    public function __construct($message = 'Freeze incorrect date frames.', $code = 422, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
