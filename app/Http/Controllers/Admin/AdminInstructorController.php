<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;

class AdminInstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::orderBy('Id_Instruktur', 'desc')->get();
        return view('admin.instructors', compact('instructors'));
    }

    public function create()
    {
        return view('admin.instructor_add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama_Instruktur' => ['required', 'string', 'max:255'],
            'Pengalaman' => ['nullable', 'string', 'max:255'],
            'Level_Kelas' => ['nullable', 'string', 'max:255'],
        ]);

        Instructor::create($validated);

        return redirect()->route('admin.instructors')->with('success', 'Instruktur berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $instructor = Instructor::findOrFail($id);
        return view('admin.instructor_edit', compact('instructor'));
    }

    public function update(Request $request, $id)
    {
        $instructor = Instructor::findOrFail($id);

        $validated = $request->validate([
            'Nama_Instruktur' => ['required', 'string', 'max:255'],
            'Pengalaman' => ['nullable', 'string', 'max:255'],
            'Level_Kelas' => ['nullable', 'string', 'max:255'],
        ]);

        $instructor->update($validated);

        return redirect()->route('admin.instructors')->with('success', 'Instruktur berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();

        return redirect()->route('admin.instructors')->with('success', 'Instruktur berhasil dihapus.');
    }
}

