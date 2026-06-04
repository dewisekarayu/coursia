@extends('admin.layout')

@section('content')
<h1 class='page-title'>Edit Instruktur</h1>
<section class='card'>
  <form method='POST' action='{{ route("admin.instructors.update", $instructor->Id_Instruktur) }}' class='form'>
    @csrf
    @method('PUT')

    <label>Nama Instruktur
      <input name='Nama_Instruktur' required value='{{ old('Nama_Instruktur', $instructor->Nama_Instruktur) }}'>
    </label>

    <label>Pengalaman
      <input name='Pengalaman' value='{{ old('Pengalaman', $instructor->Pengalaman) }}'>
    </label>

    <label>Level Kelas
      <input name='Level_Kelas' value='{{ old('Level_Kelas', $instructor->Level_Kelas) }}'>
    </label>

    <div class='form-actions'>
      <button class='btn' type='submit'>Update</button>
      <a class='btn ghost' href='{{ route("admin.instructors") }}'>Batal</a>
    </div>
  </form>
</section>
@endsection

