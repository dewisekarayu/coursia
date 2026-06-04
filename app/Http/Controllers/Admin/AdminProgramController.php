<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Instructor;
use App\Models\Program;
use Illuminate\Http\Request;

class AdminProgramController extends Controller
{
    public function index()
    {
        $programs = Program::with('instructor')->orderBy('id_program', 'desc')->get();
        return view('admin.programs', compact('programs'));
    }

    public function create()
    {
        $instructors = Instructor::orderBy('Nama_Instruktur')->get();
        return view('admin.program_add', compact('instructors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_program' => 'required|string|max:255',
            'id_instruktur' => 'nullable|integer',
            'deskripsi' => 'nullable|string',
            'level' => 'nullable|string|max:50',
            'harga' => 'nullable|numeric',
            'durasi' => 'nullable|string|max:50',
        ]);

        $program = Program::create([
            'nama_program' => $data['nama_program'],
            'id_instruktur' => $data['id_instruktur'] ?? null,
            'deskripsi' => $data['deskripsi'] ?? null,
            'level' => $data['level'] ?? null,
            'harga' => $data['harga'] ?? 0,
            'durasi' => $data['durasi'] ?? null,
        ]);

        ActivityLog::create([
            'user_id' => session('admin.id') ?? null,
            'aksi' => 'Tambah Program',
            'deskripsi' => 'Menambah program: ' . ($program->nama_program ?? ''),
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ]);

        return redirect()->route('admin.programs')
            ->with('success', 'Program berhasil disimpan.');
    }

    public function edit($id)
    {
        $program = Program::findOrFail($id);
        $instructors = Instructor::orderBy('Nama_Instruktur')->get();

        return view('admin.program_edit', compact('program', 'instructors'));
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $data = $request->validate([
            'nama_program' => 'required|string|max:255',
            'id_instruktur' => 'nullable|integer',
            'deskripsi' => 'nullable|string',
            'level' => 'nullable|string|max:50',
            'harga' => 'nullable|numeric',
            'durasi' => 'nullable|string|max:50',
        ]);

        $program->update([
            'nama_program' => $data['nama_program'],
            'id_instruktur' => $data['id_instruktur'] ?? null,
            'deskripsi' => $data['deskripsi'] ?? null,
            'level' => $data['level'] ?? null,
            'harga' => $data['harga'] ?? 0,
            'durasi' => $data['durasi'] ?? null,
        ]);

        ActivityLog::create([
            'user_id' => session('admin.id') ?? null,
            'aksi' => 'Edit Program',
            'deskripsi' => 'Memperbarui program: ' . ($program->nama_program ?? ''),
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ]);

        return redirect()->route('admin.programs')
            ->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $program = Program::findOrFail($id);
        $program->delete();

        ActivityLog::create([
            'user_id' => session('admin.id') ?? null,
            'aksi' => 'Hapus Program',
            'deskripsi' => 'Menghapus program: ' . ($program->nama_program ?? ''),
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ]);

        return redirect()->route('admin.programs')
            ->with('success', 'Program berhasil dihapus.');
    }
}
