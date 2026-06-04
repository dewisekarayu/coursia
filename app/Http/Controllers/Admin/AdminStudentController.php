<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminStudentController extends Controller
{
    public function index()
    {
        $students = DB::table('daftar_kursus')
            ->orderByDesc('id_kursus')
            ->get();

        return view('admin.students_index', compact('students'));
    }

    public function create()
    {
        $programs = DB::table('program')
            ->orderBy('nama_program')
            ->get();

        $users = DB::table('user')
            ->orderByDesc('id_user')
            ->get();

        return view('admin.students_add_index', compact('programs', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => ['required', 'integer', 'min:1'],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:50'],
            'program' => ['required', 'string', 'max:255'],
            'jadwal' => ['nullable', 'string', 'max:255'],
        ]);

        DB::table('daftar_kursus')->insert([
            'id_user' => $data['id_user'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'] ?? null,
            'program' => $data['program'],
            'jadwal' => $data['jadwal'] ?? null,
        ]);

        return redirect()->route('admin.students')
            ->with('success', 'Pendaftaran kursus berhasil ditambahkan.');
    }
}
