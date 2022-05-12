<?php
declare(strict_types=1);

namespace App\Library;

use ReflectionClass;

abstract class Constant
{
    public static function getConstants(): array
    {
        $oClass = new ReflectionClass(static::class);

        return array_values($oClass->getConstants());
    }
}
