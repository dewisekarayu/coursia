@extends('admin.layout')

@section('content')
  <h1 class='page-title'>Dashboard</h1>

<div class='grid'>
  <div class='card-highlight'>
    <h4>Total Pendaftaran</h4>
    <div class='num'>{{ $totalRegistrations }}</div>
  </div>
  <div class='card-highlight'>
    <h4>Instruktur</h4>
    <div class='num'>{{ $instructors }}</div>
  </div>
  <div class='card-highlight'>
    <h4>Program</h4>
    <div class='num'>{{ $programs }}</div>
  </div>
  <div class='card-highlight'>
    <h4>Pembayaran Pending</h4>
    <div class='num'>{{ $pendingPayments }}</div>
  </div>
</div>

<section class='card'>
  <h4>Recent Registrations</h4>
  <table class='table'>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Program</th>
        <th>Jadwal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($recentStudents as $student)
        <tr>
          <td>{{ $student->nama }}</td>
          <td>{{ $student->email }}</td>
          <td>{{ $student->program }}</td>
          <td>{{ $student->jadwal }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</section>

@endsection
