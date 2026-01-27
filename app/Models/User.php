<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $password
 * @property string $referral_link
 * @property int $balance
 * @property int|null $parent_id
 *
 * @property-read Collection<Slot> $slots
 * @property-read User $parent
 */
class User extends Authenticatable
{
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function slots(): HasMany
    {
        return $this->hasMany(Slot::class, 'owner_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
