@extends('admin.layout')

@section('content')
<?php 
include 'koneksi.php';
include 'auth.php';

$id = intval($_GET['id'] ?? 0);

if($id){ 
    $del = $conn->prepare("DELETE FROM jadwal WHERE id_jadwal=?"); 
    $del->bind_param('i', $id); 
    $del->execute(); 
}

header('Location: schedules.php'); 
exit;

@endsection
