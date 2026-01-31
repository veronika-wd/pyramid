<?php

namespace App\Queries;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ActivityLogQuery
{
    /**
     * @return Collection<ActivityLog>
     */
    public function filter(User $user, Request $request): Collection
    {
        $query = $user->activityLogs();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        return $query->get();
    }
}
