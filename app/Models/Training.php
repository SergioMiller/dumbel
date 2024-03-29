<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * @property int $id
 * @property int $gym_id
 * @property int $user_id
 * @property int|null $gym_membership_id
 * @property int|null $trainer_id
 * @property int $manager_id
 * @property int|null $locker_number
 * @property Carbon|string $started_at
 * @property Carbon|string|null $finished_at
 * @property Carbon|string $created_at
 * @property Carbon|string|null $updated_at
 * @property-read User $user
 * @property-read Gym $gym
 * @property-read UserGymMembership|null $gymMembership
 * @property-read User|null $trainer
 * @property-read User| $manager
 */
class Training extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'gym_id',
        'user_id',
        'gym_membership_id',
        'trainer_id',
        'manager_id',
        'started_at',
        'locker_number',
    ];

    protected $casts = [
        'started_at' => 'datetime:Y-m-d H:i:s',
        'finished_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }

    public function gymMembership(): BelongsTo
    {
        return $this->belongsTo(UserGymMembership::class);
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
