@extends('admin.layout')

@section('content')
<?php 


$id = intval($_GET['id'] ?? 0);

$stmt = $conn->prepare("
    SELECT 
        pb.id AS id_pembayaran,
        usr.name AS student,
        pr.name AS program,
        pb.amount AS jumlah,
        pb.payment_method AS metode_pembayaran,
        pb.status,
        pb.paid_at AS tanggal_bayar
    FROM pembayaran pb
    LEFT JOIN course_registrations pd ON pd.id = pb.course_registration_id
    LEFT JOIN users usr ON usr.id = pd.user_id
    LEFT JOIN programs pr ON pr.id = pd.program_id
    WHERE pb.id = ?

"); 
$stmt->bind_param('i', $id);

$stmt->execute(); 
$stmt->bind_result($pid, $sname, $pname, $jumlah, $metode, $status, $tanggal); 
$stmt->fetch(); 
$stmt->close(); 
?>

<h1 class='page-title'>Detail Pembayaran</h1>
<section class='card'>
    <p>Nama: <?php echo htmlspecialchars($sname ?? '-'); ?></p>
    <p>Program: <?php echo htmlspecialchars($pname ?? '-'); ?></p>
    <p>Jumlah: <?php echo $jumlah ? 'Rp ' . number_format($jumlah, 0, ',', '.') : '-'; ?></p>
    <p>Metode Pembayaran: <?php echo htmlspecialchars($metode ?? '-'); ?></p>

    <p>Status: <?php echo htmlspecialchars($status ?? '-'); ?></p>
    <p>Tanggal Bayar: <?php echo htmlspecialchars($tanggal ?? '-'); ?></p>

    <div class='form-actions'>
        <a class='btn' href='payments.php'>Kembali</a>
    </div>

</section>

@endsection
