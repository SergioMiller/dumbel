<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

class UserDontHaveGymMembershipException extends ResponsableException
{
    public function __construct($message = 'User dont have gym membership.', $code = 422, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
