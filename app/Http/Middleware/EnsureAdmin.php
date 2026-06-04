<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $admin = session()->get('admin');

        // Bentuk session harus valid, bukan hanya "ada".
        if (!is_array($admin) || empty($admin['id_admin']) || empty($admin['email'])) {
            return redirect()->route('admin.login.form');
        }

        return $next($request);
    }
}



