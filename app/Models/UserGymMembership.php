<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property int $user_id
 * @property int $gym_id
 * @property int $gym_membership_id
 * @property int $administrator_id
 * @property string $name
 * @property int $day_quantity
 * @property int $freeze_day_quantity
 * @property int $works_from
 * @property int $works_to
 * @property int $training_quantity
 * @property int $price
 * @property string $status
 * @property string $date_start
 * @property-read string $date_end
 * @property-read Collection|array $freezes
 * @property string|Carbon $created_at
 * @property string|Carbon $updated_at
 */
class UserGymMembership extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gym_id',
        'gym_membership_id',
        'administrator_id',
        'name',
        'day_quantity',
        'freeze_day_quantity',
        'works_from',
        'works_to',
        'training_quantity',
        'price',
        'status',
        'date_start',
        'created_at',
        'updated_at',
    ];

    /**
     * @return HasMany
     */
    public function freezes(): HasMany
    {
        return $this->hasMany(UserGymMembershipFreeze::class)->orderBy('date_start');
    }

    public function getDateEndAttribute(): string
    {
        return Carbon::createFromDate($this->date_start)
            ->addDays($this->day_quantity)
            ->addDays($this->freezes->sum('day_quantity'))
            ->toDateString();
    }
}
