<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 1. PENTING: Import model Pembayaran kamu di sini agar data bisa disimpan ke database
use App\Models\Pembayaran; 

class InvoiceController extends Controller
{
    public function show(Request $request)
    {
        $data = $request->only(['course_registration_id', 'paket', 'harga', 'name', 'email', 'method']);
        return view('invoice', $data);
    }

    public function processPayment(Request $request)
    {
        // 1. Validasi data yang masuk
        $validated = $request->validate([
            'course_registration_id' => 'required',
            'paket'                  => 'required',
            'harga'                  => 'required',
            'name'                   => 'required|string|max:255',
            'email'                  => 'required|email',
            'method'                 => 'required',
        ]);

        // 2. Simpan ke database menggunakan data dari $validated atau $request->input()
        // Ini dijamin aman dan menghilangkan warna merah di VS Code
        Pembayaran::create([
            'course_registration_id' => $validated['course_registration_id'],
            'nama_siswa'             => $validated['name'],
            'email'                  => $validated['email'],
            'paket'                  => $validated['paket'],
            'total_harga'            => $validated['harga'],
            'metode_pembayaran'      => $request->input('method'), // Menggunakan input() agar tidak bentrok dengan method() bawaan Laravel
            'status'                 => 'pending' 
        ]);

        // 3. Redirect ke halaman dashboard admin
        return redirect()->route('admin.dashboard')->with('success', 'Pembayaran berhasil disimpan!');
    }
}