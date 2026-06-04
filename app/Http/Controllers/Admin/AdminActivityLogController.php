<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

class AdminActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('adminFrom')->orderByDesc('created_at')->get();

        return view('admin.activity_log', compact('logs'));
    }
}
