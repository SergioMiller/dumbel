<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $uuid
 * @property string $source
 */
class QrCode extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;
}
