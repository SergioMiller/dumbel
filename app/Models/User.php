<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $lastname
 * @property string $phone
 * @property string $email
 * @property string $status
 * @property string $password
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'phone',
        'name',
        'lastname',
        'email',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    public function gyms(): HasMany
    {
        return $this->hasMany(Gym::class)->orderByDesc('created_at');
    }

    public function qrCode(): HasOne
    {
        return $this->hasOne(QrCode::class);
    }
}
