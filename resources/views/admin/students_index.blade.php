@extends('admin.layout')

@section('content')
  <h1 class='page-title'>Daftar Kursus</h1>

  <section class='card'>
    <div class='card-actions'>
      <a class='btn' href='{{ url('/admin/students/add') }}'>Tambah Pendaftaran</a>
      <input id='tableSearch' class='input' placeholder='Cari nama atau email...'>
    </div>

    <table class='table' id='studentsTable'>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>No HP</th>
          <th>Program</th>
          <th>Jadwal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($students as $student)
          <tr>
            <td>{{ $student->nama }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->no_hp ?: '-' }}</td>
            <td>{{ $student->program ?: '-' }}</td>
            <td>{{ $student->jadwal ?: '-' }}</td>
            <td>
              <a class='btn-sm' href='{{ url('/admin/students/edit/'.$student->id_kursus) }}'>Edit</a>
              
              <form action="{{ url('/admin/students/'.$student->id_kursus) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sm danger" style="border: none; cursor: pointer;" onclick='return confirm("Apakah Anda yakin ingin menghapus pendaftaran kursus ini?")'>
                  Hapus
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </section>

  <script>
  const searchInput = document.getElementById('tableSearch');
  const tbody = document.getElementById('studentsTable').getElementsByTagName('tbody')[0];
  if (searchInput && tbody) {
    searchInput.addEventListener('keyup', function() {
      const filter = this.value.toLowerCase();
      Array.from(tbody.rows).forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
      });
    });
  }
  </script>
@endsection