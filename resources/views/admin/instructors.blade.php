@extends('admin.layout')

@section('content')
<h1 class='page-title'>Instruktur</h1>
<section class='card'>
  <div class='card-actions'>
    <a class='btn' href='{{ route("admin.instructors.add") }}'>Tambah Instruktur</a>
  </div>

  <table class='table'>
    <thead>
      <tr>
        <th>Nama Instruktur</th>
        <th>Pengalaman</th>
        <th>Level Kelas</th>
        <th>Aksi</th>
      </tr>
    </thead>

    <tbody>
      @foreach($instructors as $r)
      <tr>
        <td>{{ $r->Nama_Instruktur }}</td>
        <td>{{ $r->Pengalaman ?? '-' }}</td>
        <td>{{ $r->Level_Kelas ?? '-' }}</td>
        <td>
          <a class='btn-sm' href='{{ route("admin.instructors.edit", $r->Id_Instruktur) }}'>Edit</a>

          <form method='POST' action='{{ route("admin.instructors.destroy", $r->Id_Instruktur) }}' style='display:inline' onsubmit='return confirm("Hapus?")'>
            @csrf
            @method('DELETE')
            <button class='btn-sm danger' type='submit'>Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</section>
@endsection

