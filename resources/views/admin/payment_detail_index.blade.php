@extends('admin.layout')

@section('content')
  <h1 class='page-title'>Detail Pembayaran</h1>
  <section class='card'>
    <div class='alert'>Halaman detail masih legacy. Untuk sementara kembali ke halaman pembayaran.</div>
    <a class='btn' href='{{ url('/admin/payments') }}'>Kembali</a>
  </section>
@endsection

