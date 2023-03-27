<?php
declare(strict_types=1);

namespace App\Services;

use Picqer\Barcode\BarcodeGeneratorPNG;

class BarcodeGeneratorService
{
    public function __construct(private readonly BarcodeGeneratorPNG $barcodeGenerator)
    {
    }

    public function getFilePng(string $code, string $encoding): string
    {
        return $this->barcodeGenerator->getBarcode($code, $encoding, 3, 40);
    }
}
