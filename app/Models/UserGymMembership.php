<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $gym_id
 * @property int $administrator_id
 * @property string $name
 * @property int $day_quantity
 * @property int $works_from
 * @property int $works_to
 * @property int $training_quantity
 * @property int $price
 * @property string|Carbon $created_at
 */
class UserGymMembership extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'gym_id',
        'administrator_id',
        'name',
        'day_quantity',
        'works_from',
        'works_to',
        'training_quantity',
        'price',
        'created_at',
    ];
}
