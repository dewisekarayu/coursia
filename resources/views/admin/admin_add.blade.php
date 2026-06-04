@extends('admin.layout')

@section('content')

<h1 class='page-title'>Tambah Admin</h1>

<section class='card'>
  <form method='post' action='{{ route('admin.admins.store') }}' class='form'>
    @csrf

    <label>Nama
      <input name='name' required>
    </label>

    <label>Email
      <input name='email' type='email' required>
    </label>

    <label>Role
      <select name='role' required>
        <option value='superadmin'>Super Admin</option>
        <option value='admin_kursus'>Admin Kursus</option>
        <option value='admin_keuangan'>Admin Keuangan</option>
      </select>
    </label>

    <label>Password
      <input name='password' type='password' required>
    </label>

    <div class='form-actions'>
      <button class='btn' type='submit'>Simpan</button>
      <a class='btn ghost' href='{{ route('admin.admins') }}'>Batal</a>
    </div>

  </form>
</section>

@endsection
