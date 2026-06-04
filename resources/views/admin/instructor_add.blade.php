@extends('admin.layout')

@section('content')
<h1 class='page-title'>Tambah Instruktur</h1>
<section class='card'>
  <form method='POST' action='{{ route("admin.instructors.store") }}' class='form'>
    @csrf

    <label>Nama Instruktur
      <input name='Nama_Instruktur' required value='{{ old('Nama_Instruktur') }}'>
    </label>

    <label>Pengalaman
      <input name='Pengalaman' value='{{ old('Pengalaman') }}'>
    </label>

    <label>Level Kelas
      <input name='Level_Kelas' value='{{ old('Level_Kelas') }}'>
    </label>

    <div class='form-actions'>
      <button class='btn' type='submit'>Simpan</button>
      <a class='btn ghost' href='{{ route("admin.instructors") }}'>Batal</a>
    </div>
  </form>
</section>
@endsection

