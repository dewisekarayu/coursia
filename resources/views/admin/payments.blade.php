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
      <?php 
      $q = $conn->query("
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
        ORDER BY pb.id DESC

      "); 
      while($r = $q->fetch_assoc()): 
      ?>
      <tr>
        <td><?php echo htmlspecialchars($r['student'] ?? '-'); ?></td>
        <td><?php echo htmlspecialchars($r['program'] ?? '-'); ?></td>
        <td><?php echo $r['jumlah'] ? 'Rp ' . number_format($r['jumlah'], 0, ',', '.') : '-'; ?></td>
        <td><?php echo htmlspecialchars($r['metode_pembayaran'] ?? '-'); ?></td>
        <td><?php echo htmlspecialchars($r['status'] ?? '-'); ?></td>
        <td><?php echo $r['tanggal_bayar'] ?? '-'; ?></td>

        <td>

          <a class='btn-sm' href='payment_detail.php?id=<?php echo $r['id_pembayaran']; ?>'>Detail</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</section>

@endsection
