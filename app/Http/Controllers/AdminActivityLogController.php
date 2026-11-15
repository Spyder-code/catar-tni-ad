<?php

namespace App\Http\Controllers;

use App\Models\AdminActivityLog;
use Illuminate\Http\Request;

class AdminActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'role' => 'nullable|in:admin,superadmin',
            'user_id' => 'nullable|integer|min:1',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
        ]);

        $logs = AdminActivityLog::query()
            ->when($filters['role'] ?? null, fn ($query, $role) => $query->where('user_role', $role))
            ->when($filters['user_id'] ?? null, fn ($query, $userId) => $query->where('user_id', $userId))
            ->when($filters['date_from'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
            ->when($filters['date_to'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '<=', $date))
            ->orderByDesc('id')->paginate(50)->withQueryString();

        return view('admin.activity-log', compact('logs', 'filters'));
    }
}
