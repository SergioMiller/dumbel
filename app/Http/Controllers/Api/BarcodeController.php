<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barcode;
use App\Services\BarcodeGeneratorService;
use Illuminate\Http\Response;

final class BarcodeController extends Controller
{
    public function barcode(int $id, BarcodeGeneratorService $barcodeGeneratorService): Response
    {
        /**
         * @var Barcode $barcode
         */
        $barcode = Barcode::query()->where('id', $id)->first();

        abort_if(null === $barcode, 404);

        $response = new Response($barcodeGeneratorService->getFilePng($barcode->code, $barcode->encoding), 200);
        $response->header('Content-Type', 'image/png');

        return $response;
    }
}
