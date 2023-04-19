<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\GymEmployeePositionEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $status
 * @property string|Carbon $created_at
 * @property string|Carbon $updated_at
 * @property User[]|Collection $trainers
 * @property User[]|Collection $managers
 */
class Gym extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'phone',
        'email',
        'address',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gymMembership(): HasMany
    {
        return $this->hasMany(GymMembership::class);
    }

    public function employeePivot(): HasMany
    {
        return $this->hasMany(GymEmployee::class);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'gym_employees');
    }

    public function trainers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'gym_employees')
            ->where('gym_employees.position', GymEmployeePositionEnum::TRAINER->value);
    }

    public function managers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'gym_employees')
            ->where('gym_employees.position', GymEmployeePositionEnum::MANAGER->value);
    }
}
