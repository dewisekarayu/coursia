@extends('admin.layout')

@section('content')
<h1 class='page-title'>Activity Log</h1>

<section class='card'>
  <table class='table'>
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>User</th>
        <th>Aksi</th>
        <th>Deskripsi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($logs as $log)
        <tr>
          <td>{{ $log->created_at }}</td>
          <td>{{ $log->adminFrom->nama ?? 'Unknown' }}</td>
          <td>{{ $log->aksi }}</td>
          <td>{{ $log->deskripsi }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</section>
@endsection
