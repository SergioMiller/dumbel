<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

class FreezeDaysHasCrossDatesException extends ResponsableException
{
    public function __construct($message = 'Freeze days has cross dates.', $code = 422, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
