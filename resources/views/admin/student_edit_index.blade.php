@extends('admin.layout')

@section('content')
  <h1 class='page-title'>Edit Pendaftaran Kursus</h1>
  <section class='card'>
    <div class='alert'>Halaman edit masih legacy. Untuk sementara kembali ke daftar siswa.</div>
    <a class='btn' href='{{ url('/admin/students') }}'>Kembali</a>
  </section>
@endsection

