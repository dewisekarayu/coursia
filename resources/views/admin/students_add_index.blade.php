@extends('admin.layout')

@section('content')
  <h1 class='page-title'>Tambah Pendaftaran Kursus</h1>

  <section class='card'>
    @if(!empty($errors))
      <div class='alert'>
        @if(is_array($errors))
          {!! implode('<br>', $errors) !!}
        @else
          {!! implode('<br>', $errors->all()) !!}
        @endif
      </div>
    @endif

    <form method='post' action='{{ route('admin.students.store') }}' class='form'>
      @csrf

      <label>User
        <select name='id_user' required>
          <option value=''>Pilih User</option>
          @foreach($users as $user)
            <option value='{{ $user->id_user }}' {{ old('id_user') == $user->id_user ? 'selected' : '' }}>{{ $user->email }}</option>
          @endforeach
        </select>
      </label>

      <label>Nama
        <input name='nama' value='{{ old('nama') }}' required>
      </label>

      <label>Email
        <input name='email' type='email' value='{{ old('email') }}' required>
      </label>

      <label>No HP
        <input name='no_hp' value='{{ old('no_hp') }}'>
      </label>

      <label>Program
        <input name='program' list='programs' value='{{ old('program') }}' required>
        <datalist id='programs'>
          @foreach($programs as $program)
            <option value='{{ $program->nama_program }}'>
          @endforeach
        </datalist>
      </label>

      <label>Jadwal
        <input name='jadwal' value='{{ old('jadwal') }}'>
      </label>

      <div class='form-actions'>
        <button class='btn' type='submit'>Simpan</button>
        <a class='btn ghost' href='{{ url('/admin/students') }}'>Batal</a>
      </div>
    </form>
  </section>
@endsection

