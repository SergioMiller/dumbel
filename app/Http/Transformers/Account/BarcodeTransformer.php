<?php

declare(strict_types=1);

namespace App\Http\Transformers\Account;

use App\Library\Transformer\Transformer;
use App\Models\Barcode;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="AccountBarcodeTransformer")
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
    public function toArray(Barcode $entity): array
    {
        return [
            'id' => $entity->id,
            'code' => $entity->code,
            'encoding' => $entity->encoding,
            'type' => $entity->type,
            'image_url' => route('api.barcode.get', $entity->id),
            'created_at' => $entity->created_at->toDateTimeString(),
        ];
    }
}
