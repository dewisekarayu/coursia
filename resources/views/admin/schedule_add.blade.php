@extends('admin.layout')

@section('content')
<h1 class='page-title'>Tambah Jadwal</h1>
<section class='card'>
  <form method='post' action='{{ route('admin.schedules.store') }}' class='form'>
    @csrf
    <label>Program
      <select name='id_program' required>
        <option value=''>Pilih Program</option>
        @foreach($programs as $program)
          <option value='{{ $program->id_program }}'>{{ $program->nama_program }}</option>
        @endforeach
      </select>
    </label>
    <label>Hari
      <input name='hari' value='{{ old('hari') }}' required>
    </label>
    <label>Jam Mulai
      <input name='jam_mulai' type='time' value='{{ old('jam_mulai') }}' required>
    </label>
    <label>Jam Selesai
      <input name='jam_selesai' type='time' value='{{ old('jam_selesai') }}' required>
    </label>
    <label>Lokasi
      <input name='lokasi' value='{{ old('lokasi') }}'>
    </label>
    <div class='form-actions'>
      <button class='btn' type='submit'>Simpan</button>
      <a class='btn ghost' href='{{ route('admin.schedules') }}'>Batal</a>
    </div>
  </form>
</section>

@endsection
