@extends('admin.layout')

@section('content')
<h1 class='page-title'>Program</h1>

<section class='card'>

  <div class='card-actions'>
    <a class='btn' href='{{ route('admin.programs.add') }}'>Tambah Program</a>
  </div>

  <table class='table'>
    <thead>
      <tr>
        <th>Instruktur</th>
        <th>Nama Program</th>
        <th>Deskripsi</th>
        <th>Level</th>
        <th>Harga</th>
        <th>Durasi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($programs as $program)
        <tr>
          <td>{{ $program->instructor->Nama_Instruktur ?? '-' }}</td>
          <td>{{ $program->nama_program }}</td>
          <td>{{ $program->deskripsi }}</td>
          <td>{{ $program->level }}</td>
          <td>{{ number_format($program->harga ?? 0, 0, ',', '.') }}</td>
          <td>{{ $program->durasi ?? '-' }}</td>
          <td style="white-space: nowrap;">
            <a class='btn-sm' href='{{ route('admin.programs.edit', $program->id_program) }}'>Edit</a>
            <form action='{{ route('admin.programs.destroy', $program->id_program) }}' method='post' style='display:inline'>
              @csrf
              @method('DELETE')
              <button type='submit' class='btn-sm danger' onclick='return confirm("Yakin hapus program ini?")'>Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

</section>

@endsection
