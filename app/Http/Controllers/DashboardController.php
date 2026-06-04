<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseRegistration;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User|null $user */
        $user = Auth::user();
        $registrations = $user
            ? $user->courseRegistrations()->with('pembayaran')->latest()->get()
            : collect();

        return view('dashboard', compact('user', 'registrations'));
    }
}
