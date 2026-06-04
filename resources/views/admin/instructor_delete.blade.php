@extends('admin.layout')

@section('content')
<h1 class='page-title'>Hapus Instruktur</h1>
<section class='card'>
  <p>Apakah yakin menghapus instruktur?</p>

  <form method='POST' action='{{ route("admin.instructors.destroy", $id) }}'>
    @csrf
    @method('DELETE')

    <div class='form-actions'>
      <button class='btn danger' type='submit'>Hapus</button>
      <a class='btn ghost' href='{{ route("admin.instructors") }}'>Batal</a>
    </div>
  </form>
</section>
@endsection

