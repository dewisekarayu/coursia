<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $admins = Admin::orderByDesc('id_admin')->get();
        return view('admin.admin_users', compact('admins'));
    }

    public function create()
    {
        return view('admin.admin_add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admin,email',
            'role' => 'required|in:superadmin,admin_kursus,admin_keuangan',
            'password' => 'required|string|min:8',
        ]);

        Admin::create([
            'nama' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.admins')
            ->with('success', 'Admin baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admin_edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admin,email,' . $admin->id_admin . ',id_admin',
            'role' => 'required|in:superadmin,admin_kursus,admin_keuangan',
            'password' => 'nullable|string|min:8',
        ]);

        $admin->nama = $data['name'];
        $admin->email = $data['email'];
        $admin->role = $data['role'];

        if (!empty($data['password'])) {
            $admin->password = Hash::make($data['password']);
        }

        $admin->save();

        return redirect()->route('admin.admins')
            ->with('success', 'Data admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.admins')
            ->with('success', 'Admin berhasil dihapus.');
    }
}
