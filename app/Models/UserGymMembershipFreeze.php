<?php
declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * @property int $id
 * @property int $user_gym_membership_id
 * @property int $date_start
 * @property int $date_end
 * @property int $day_quantity
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 */
class UserGymMembershipFreeze extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'user_gym_membership_id',
        'date_start',
        'date_end',
        'day_quantity',
    ];
}
