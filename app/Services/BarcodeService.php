<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Barcode;

class BarcodeService
{
    public function generate(): string
    {
        do {
            $code = $this->generateEAN8();
        } while (Barcode::query()->where('code', $code)->exists());

        return $code;
    }

    public function generateEAN8(): string
    {
        $code = '';
        // Генеруємо перші 7 цифр
        for ($i = 0; $i < 7; $i++) {
            $code .= random_int(0, 9);
        }
        // Обчислюємо контрольну суму
        $checksum = (3 * ($code[0] + $code[2] + $code[4] + $code[6])) + ($code[1] + $code[3] + $code[5]);
        $checksum = (10 - ($checksum % 10)) % 10;
        // Додаємо контрольну суму до коду
        $code .= $checksum;

        return $code;
    }
}
