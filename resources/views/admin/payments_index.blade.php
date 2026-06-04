@extends('admin.layout')

@section('content')
  <h1 class='page-title'>Pembayaran</h1>

  <section class='card'>
    <table class='table'>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Program</th>
          <th>Jumlah</th>
          <th>Metode</th>
          <th>Status</th>
          <th>Tanggal Bayar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($payments as $payment)
          <tr>
            <td>{{ $payment->student ?: '-' }}</td>
            <td>{{ $payment->program ?: '-' }}</td>
            <td>{{ $payment->jumlah ? 'Rp '.number_format($payment->jumlah,0,',','.') : '-' }}</td>
            <td>{{ $payment->metode_pembayaran ?: '-' }}</td>
            <td>{{ $payment->status ?: '-' }}</td>
            <td>{{ $payment->tanggal_bayar ?: '-' }}</td>
            <td>
              <a class='btn-sm' href='#'>Detail</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </section>
@endsection

