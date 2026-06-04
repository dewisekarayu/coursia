@extends('admin.layout')

@section('content')
<h1 class='page-title'>Jadwal</h1>
<section class='card'>
  <div class='card-actions'>
    <a class='btn' href='{{ route('admin.schedules.add') }}'>Tambah Jadwal</a>
  </div>
  <table class='table'>
    <thead>
      <tr>
        <th>Program</th>
        <th>Hari</th>
        <th>Jam Mulai</th>
        <th>Jam Selesai</th>
        <th>Lokasi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($schedules as $schedule)
        <tr>
          <td>{{ $schedule->program->nama_program ?? '-' }}</td>
          <td>{{ $schedule->hari ?? '-' }}</td>
          <td>{{ $schedule->jam_mulai ? \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') : '-' }}</td>
          <td>{{ $schedule->jam_selesai ? \Carbon\Carbon::parse($schedule->jam_selesai)->format('H:i') : '-' }}</td>
          <td>{{ $schedule->lokasi ?? '-' }}</td>
          <td style="white-space: nowrap;">
            <a class='btn-sm' href='{{ route('admin.schedules.edit', $schedule->id_jadwal) }}'>Edit</a>
            <form action='{{ route('admin.schedules.destroy', $schedule->id_jadwal) }}' method='post' style='display:inline'>
              @csrf
              @method('DELETE')
              <button type='submit' class='btn-sm danger' onclick='return confirm("Yakin hapus jadwal ini?")'>Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</section>

@endsection
