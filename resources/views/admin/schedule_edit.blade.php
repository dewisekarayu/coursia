@extends('admin.layout')

@section('content')

<h1 class='page-title'>Edit Jadwal</h1>
<section class='card'>
  <form method='post' action='{{ route('admin.schedules.update', $schedule->id_jadwal) }}' class='form'>
    @csrf
    @method('PUT')

    <label>Program
      <select name='id_program' required>
        <option value=''>Pilih Program</option>
        @foreach($programs as $program)
          <option value='{{ $program->id_program }}' {{ old('id_program', $schedule->id_program) == $program->id_program ? 'selected' : '' }}>
            {{ $program->nama_program }}
          </option>
        @endforeach
      </select>
    </label>
    <label>Hari
      <input name='hari' value='{{ old('hari', $schedule->hari) }}' required>
    </label>
    <label>Jam Mulai
      <input name='jam_mulai' type='time' value='{{ old('jam_mulai', optional($schedule->jam_mulai) ? \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') : '') }}' required>
    </label>
    <label>Jam Selesai
      <input name='jam_selesai' type='time' value='{{ old('jam_selesai', optional($schedule->jam_selesai) ? \Carbon\Carbon::parse($schedule->jam_selesai)->format('H:i') : '') }}' required>
    </label>
    <label>Lokasi
      <input name='lokasi' value='{{ old('lokasi', $schedule->lokasi) }}'>
    </label>
    <div class='form-actions'>
      <button class='btn' type='submit'>Update</button>
      <a class='btn ghost' href='{{ route('admin.schedules') }}'>Batal</a>
    </div>
  </form>
</section>

@endsection
