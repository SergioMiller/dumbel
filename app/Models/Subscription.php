<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $gym_id
 * @property string $name
 * @property integer $day_quantity
 * @property integer $works_from
 * @property integer $works_to
 * @property integer $training_quantity
 * @property integer $price
 * @property string|Carbon $created_at
 * @property string|Carbon $updated_at
 * @property Gym $gym
 */
class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'gym_id',
        'name',
        'day_quantity',
        'works_from',
        'works_to',
        'training_quantity',
        'price',
    ];

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }
}
