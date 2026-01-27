<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $owner_id
 * @property int|null $user_id
 */
class Slot extends Model
{
    public const PRICE = 500;

    protected $guarded = ['id'];
}
