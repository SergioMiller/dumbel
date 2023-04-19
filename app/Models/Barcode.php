<?php
declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $gym_id
 * @property string $code
 * @property string $encoding
 * @property string $type
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 */
class Barcode extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }
}
