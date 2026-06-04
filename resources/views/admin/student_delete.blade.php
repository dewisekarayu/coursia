@extends('admin.layout')

@section('content')
<?php 
include 'koneksi.php'; 
include 'auth.php';

$id = intval($_GET['id'] ?? 0);

if ($id) {
    $del = $conn->prepare("DELETE FROM daftar_kursus WHERE id_kursus=?");
    $del->bind_param('i', $id);
    $del->execute();
}

header('Location: students.php'); 
exit;
?>

@endsection
