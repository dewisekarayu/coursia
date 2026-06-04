@extends('admin.layout')

@section('content')
  <h1 class='page-title'>Hapus Pendaftaran Kursus</h1>
  <section class='card'>
    <div class='alert alert-danger'>
      Apakah Anda yakin ingin menghapus pendaftaran kursus atas nama <strong>{{ $registration->name }}</strong>? Tindakan ini tidak dapat dibatalkan.
    </div>
    
    <!-- Form untuk melakukan proses delete -->
    <form action="{{ url('/admin/students/' . $registration->id) }}" method="POST" style="display: inline-block;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Ya, Hapus</button>
    </form>
    
    <a class='btn btn-secondary' href='{{ url('/admin/students') }}'>Batal</a>
  </section>
@endsection