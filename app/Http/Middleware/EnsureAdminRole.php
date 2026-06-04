<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $admin = session()->get('admin');

        if (!$admin || empty($admin['role'])) {
            return redirect('/admin/login');
        }

        $allowedRoles = preg_split('/\s*[|,]\s*/', $role, -1, PREG_SPLIT_NO_EMPTY);

        if (!in_array($admin['role'], $allowedRoles, true)) {
            return redirect('/admin');
        }

        return $next($request);
    }
}


