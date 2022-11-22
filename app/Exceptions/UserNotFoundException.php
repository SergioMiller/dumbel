<?php
declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

class UserNotFoundException extends ResponsableException
{
    public function __construct($message = 'User not found.', $code = 404, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
