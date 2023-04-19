<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $lastname
 * @property integer $phone
 * @property string $email
 * @property string $status
 * @property string $birthday
 * @property string $password
 * @property Carbon $created_at
 * @property-read Barcode[]|Collection $barcodes
 * @property-read UserGymMembership[]|Collection $gymMemberships
 */
class User extends Authenticatable implements Auditable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use AuditableTrait;

    protected $fillable = [
        'phone',
        'name',
        'lastname',
        'email',
        'status',
        'birthday',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'phone' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    public function gyms(): HasMany
    {
        return $this->hasMany(Gym::class)->orderByDesc('created_at');
    }

    public function barcodes(): HasMany
    {
        return $this->hasMany(Barcode::class)->orderByDesc('created_at');
    }

    public function gymMemberships(): HasMany
    {
        return $this->hasMany(UserGymMembership::class)->orderBy('id');
    }
}
