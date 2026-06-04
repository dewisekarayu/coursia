<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $admin = Admin::query()->where('email', $data['email'])->first();
        if (!$admin) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.'])->withInput();
        }

        $passOk = false;
        if ($admin->password) {
            $passOk = Hash::check($data['password'], $admin->password);

            // Backward compatibility jika password sempat disimpan plain.
            if (!$passOk && $data['password'] === $admin->password) {
                $passOk = true;
            }
        }

        if (!$passOk) {
            return back()->withErrors(['password' => 'Password salah!'])->withInput();
        }

        // Penting: regen session saat login sukses agar token/cookie tidak mismatch.
        $request->session()->regenerate();

        session([
            'admin' => [
                'id' => $admin->id_admin,
                'id_admin' => $admin->id_admin,
                'name' => $admin->nama,
                'email' => $admin->email,
                'role' => $admin->role,
            ],
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.form');
    }
}





