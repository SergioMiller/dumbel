<?php
declare(strict_types=1);

namespace App\Library;

interface CountryApiInterface
{
    public function getName(): string;

    public function getCode(): string;

    public function getOperatorCode(): string;

    public function getUtc(): string;
}
