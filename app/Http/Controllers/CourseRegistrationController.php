<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseRegistration;

class CourseRegistrationController extends Controller
{
    public function create()
    {
        return view('daftar');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'hp' => 'required|string|max:20',
            'program' => 'required|string|in:Kids,Teens,Adults',
            'jadwal' => 'required|string|in:Pagi,Siang,Malam',
        ]);

        $registration = CourseRegistration::create([
            'user_id' => Auth::id(),
            'name' => $data['nama'],
            'email' => $data['email'],
            'phone' => $data['hp'],
            'program' => $data['program'],
            'jadwal' => $data['jadwal'],
            'status' => 'Terdaftar',
        ]);

        return redirect()->route('payment', ['course_registration_id' => $registration->id])
            ->with('success', 'Pendaftaran kursus berhasil disimpan. Lanjutkan pembayaran.');
    }
}
