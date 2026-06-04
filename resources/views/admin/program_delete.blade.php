@extends('admin.layout')

@section('content')
<?php 
include 'koneksi.php';
include 'auth.php';

$id = intval($_GET['id'] ?? 0);

if($id){ 
    $del = $conn->prepare("DELETE FROM program WHERE id_program=?"); 
    $del->bind_param('i', $id); 
    $del->execute(); 
}

header('Location: programs.php'); 
exit;

@endsection
