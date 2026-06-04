<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AdminScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('program')->orderBy('id_jadwal', 'desc')->get();
        return view('admin.schedules', compact('schedules'));
    }

    public function create()
    {
        $programs = Program::orderBy('nama_program')->get();
        return view('admin.schedule_add', compact('programs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_program' => 'required|integer|exists:program,id_program',
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
        ]);

        Schedule::create([
            'id_program' => $data['id_program'],
            'hari' => $data['hari'],
            'jam_mulai' => $data['jam_mulai'],
            'jam_selesai' => $data['jam_selesai'],
            'lokasi' => $data['lokasi'] ?? null,
        ]);

        return redirect()->route('admin.schedules')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $programs = Program::orderBy('nama_program')->get();

        return view('admin.schedule_edit', compact('schedule', 'programs'));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $data = $request->validate([
            'id_program' => 'required|integer|exists:program,id_program',
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
        ]);

        $schedule->update([
            'id_program' => $data['id_program'],
            'hari' => $data['hari'],
            'jam_mulai' => $data['jam_mulai'],
            'jam_selesai' => $data['jam_selesai'],
            'lokasi' => $data['lokasi'] ?? null,
        ]);

        return redirect()->route('admin.schedules')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.schedules')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}
