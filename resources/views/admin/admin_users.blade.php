@extends('admin.layout')

@section('content')
<h1 class='page-title'>Admin Users</h1>
<section class='card'>
  <div class='card-actions'>
    <a class='btn' href='{{ route('admin.admins.add') }}'>Tambah Admin</a>
  </div>
  <table class='table'>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($admins as $admin)
        <tr>
          <td>{{ $admin->nama }}</td>
          <td>{{ $admin->email }}</td>
          <td>{{ $admin->role }}</td>
          <td>
            <a class='btn-sm' href='{{ route('admin.admins.edit', $admin->id_admin) }}'>Edit</a>
            <form action='{{ route('admin.admins.destroy', $admin->id_admin) }}' method='post' style='display:inline'>
              @csrf
              @method('DELETE')
              <button type='submit' class='btn-sm danger' onclick='return confirm("Yakin ingin menghapus admin ini?")'>Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</section>
@endsection
