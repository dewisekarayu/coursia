@extends('admin.layout')

@section('content')
<h1 class='page-title'>Edit Program</h1>

<section class='card'>
  <form method='post' action='{{ route('admin.programs.update', $program->id_program) }}' class='form'>
    @csrf
    @method('PUT')

    <label>Nama Program
      <input name='nama_program' required value='{{ old('nama_program', $program->nama_program) }}'>
    </label>

    <label>Instruktur
      <select name='id_instruktur'>
        <option value=''>Pilih Instruktur</option>
        @foreach($instructors as $instructor)
          <option value='{{ $instructor->Id_Instruktur }}' {{ old('id_instruktur', $program->id_instruktur) == $instructor->Id_Instruktur ? 'selected' : '' }}>
            {{ $instructor->Nama_Instruktur }}
          </option>
        @endforeach
      </select>
    </label>

    <label>Deskripsi
      <textarea name='deskripsi'>{{ old('deskripsi', $program->deskripsi) }}</textarea>
    </label>

    <label>Level
      <input name='level' value='{{ old('level', $program->level) }}'>
    </label>

    <label>Harga
      <input name='harga' type='number' step='0.01' value='{{ old('harga', $program->harga) }}'>
    </label>

    <label>Durasi
      <input name='durasi' value='{{ old('durasi', $program->durasi) }}'>
    </label>

    <div class='form-actions'>
      <button class='btn' type='submit'>Update</button>
      <a class='btn ghost' href='{{ route('admin.programs') }}'>Batal</a>
    </div>

  </form>
</section>

@endsection
