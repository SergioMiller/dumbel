<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Enums\BarcodeTypeEnum;
use App\Services\BarcodeService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;

class BarcodeFactory extends Factory
{
    public function definition(): array
    {
        /**
         * @var BarcodeService $barcodeService
         */
        $barcodeService = App::make(BarcodeService::class);

        return [
            'code' => $barcodeService->generate(),
            'encoding' => 'EAN8',
            'type' => BarcodeTypeEnum::DEFAULT->value,
        ];
    }
}
