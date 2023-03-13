<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
class Gym extends Model
{
    use HasFactory;

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

    public function trainers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'gym_trainer');
    }

    public function managers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'gym_manager');
    }
}
