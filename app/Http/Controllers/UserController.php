<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Queries\ActivityLogQuery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private ActivityLogQuery $activityLogQuery,
    )
    {
    }

    public function index(Request $request): View
    {
        $user = $request->user();

        $referrals = User::where('parent_id', $user->id)
            ->with('children.children')
            ->get();

        $activityLogs = $this->activityLogQuery->filter($user, $request);

        return view('index', [
            'slots' => $user->slots,
            'referrals' => $referrals,
            'activityLogs' => $activityLogs,
        ]);
    }
}
