<?php

declare(strict_types=1);

namespace App\Library;

trait Eventable
{
    public function handleEvent(object $event): void
    {
        event($event);
    }
}
