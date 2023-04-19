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
 * @property int $gym_id
 * @property int $user_id
 * @property string $position
 * @property Carbon|string $created_at
 * @property Carbon|string|null $updated_at
 */
class GymEmployee extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
