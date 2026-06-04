@extends('admin.layout')

@section('content')

<h1 class='page-title'>Tambah Program</h1>
<section class='card'>
  <form method='post' class='form' action="{{ route('admin.programs.store') }}">
    @csrf
    <label>Nama Program
      <input name='nama_program' required value="{{ old('nama_program') }}">
    </label>
    <label>Instruktur
      <select name='id_instruktur' required>
        <option value=''>Pilih Instruktur</option>
        @foreach($instructors as $i)
          <option value='{{ $i->Id_Instruktur }}'>{{ $i->Nama_Instruktur }}</option>
        @endforeach
      </select>
    </label>
    <label>Deskripsi
      <textarea name='deskripsi' rows='4'>{{ old('deskripsi') }}</textarea> 
    </label>
    <label>Level
      <input name='level' value="{{ old('level') }}">
    </label>
    <label>Harga
      <input name='harga' type='number' step='any' required value="{{ old('harga') }}">
    </label>
    <label>Durasi
      <input name='durasi' value="{{ old('durasi') }}">
    </label>

    <div class='form-actions'>
      <button class='btn' type='submit'>Simpan Program</button>
      <a class='btn ghost' href='{{ route('admin.programs') }}'>Batal</a>
    </div>
  </form>
</section>

@endsection
