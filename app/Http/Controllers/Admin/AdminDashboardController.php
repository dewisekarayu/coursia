<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalRegistrations = DB::table('daftar_kursus')->count();
        $instructors = DB::table('instruktur')->count();
        $programs = DB::table('program')->count();
        $pendingPayments = DB::table('pembayaran')->where('status', 'pending')->count();

        $recentStudents = DB::table('daftar_kursus')
            ->select('nama', 'email', 'program', 'jadwal')
            ->orderByDesc('id_kursus')
            ->limit(5)
            ->get();

        return view('admin.index', compact(
            'totalRegistrations',
            'instructors',
            'programs',
            'pendingPayments',
            'recentStudents'
        ));
    }
}
