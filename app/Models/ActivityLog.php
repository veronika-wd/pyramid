<?php

namespace App\Models;

use App\Enums\LogTypeEnum;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'type' => LogTypeEnum::class,
    ];
}
