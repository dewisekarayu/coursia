@extends('admin.layout')

@section('content')
    <div class="container">
        <p>Untuk logout gunakan tombol berikut:</p>
        <a href="{{ route('admin.logout') }}" class="btn">Logout</a>
    </div>
@endsection
