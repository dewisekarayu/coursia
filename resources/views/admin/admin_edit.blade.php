@extends('admin.layout')

@section('content')
<h1 class='page-title'>Edit Admin</h1>

<section class='card'>
  <form method='post' action='{{ route('admin.admins.update', $admin->id_admin) }}' class='form'>
    @csrf
    @method('PUT')

    <label>Nama
      <input name='name' value='{{ old('name', $admin->nama) }}' required>
    </label>

    <label>Email
      <input name='email' type='email' value='{{ old('email', $admin->email) }}' required>
    </label>

    <label>Role
      <select name='role' required>
        <option value='superadmin' {{ old('role', $admin->role) === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
        <option value='admin_kursus' {{ old('role', $admin->role) === 'admin_kursus' ? 'selected' : '' }}>Admin Kursus</option>
        <option value='admin_keuangan' {{ old('role', $admin->role) === 'admin_keuangan' ? 'selected' : '' }}>Admin Keuangan</option>
      </select>
    </label>

    <label>Password (kosongkan jika tidak ingin mengubah)
      <input name='password' type='password'>
    </label>

    <div class='form-actions'>
      <button class='btn' type='submit'>Update</button>
      <a class='btn ghost' href='{{ route('admin.admins') }}'>Batal</a>
    </div>
  </form>
</section>

@endsection
