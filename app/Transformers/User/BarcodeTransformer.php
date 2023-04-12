<?php

declare(strict_types=1);

namespace App\Transformers\User;

use App\Library\Transformer;
use App\Models\Barcode;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="UserBarcodeTransformer")
 *
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="code", type="string", example="0000000"),
 * @OA\Property(property="encoding", type="string", example="EAN-8"),
 * @OA\Property(property="type", type="string", example="default"),
 * @OA\Property(property="image_url", type="string", example="http://localhost:8000/api/v1/barcode/10"),
 * @OA\Property(property="created_at", type="string", format="datetime", example="2023-12-31 00:00:00"),
 */
class BarcodeTransformer extends Transformer
{
    public function toArray(Barcode $model): array
    {
        return [
            'id' => $model->id,
            'code' => $model->code,
            'encoding' => $model->encoding,
            'type' => $model->type,
            'image_url' => route('api.barcode.get', $model->id),
            'created_at' => $model->created_at->toDateTimeString(),
        ];
    }
}
