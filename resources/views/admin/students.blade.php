@extends('admin.layout')

@section('content')
<h1 class='page-title'>Daftar Kursus</h1>
<section class='card'>
  <div class='card-actions'>
    <a class='btn' href='student_add.php'>Tambah Pendaftaran</a>
    <input id='tableSearch' class='input' placeholder='Cari nama atau email...'>
  </div>
  <table class='table' id='studentsTable'>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Program</th>
        <th>Jadwal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
<?php 

$stmt = $conn->prepare("SELECT dk.id_kursus, dk.nama, dk.email, dk.no_hp, dk.program, dk.jadwal FROM daftar_kursus dk ORDER BY dk.id_kursus DESC"); 
$stmt->execute(); 
$stmt->bind_result($id, $nama, $email, $hp, $program, $jadwal); 
while($stmt->fetch()): 
?>
      <tr>
        <td><?php echo htmlspecialchars($nama ?? ''); ?></td>
        <td><?php echo htmlspecialchars($email ?? ''); ?></td>
        <td><?php echo htmlspecialchars($hp ?? '-'); ?></td>
        <td><?php echo htmlspecialchars($program ?? '-'); ?></td>
        <td><?php echo htmlspecialchars($jadwal ?? '-'); ?></td>
        <td>
          <a class='btn-sm' href='student_edit.php?id=<?php echo $id; ?>'>Edit</a>
          <a class='btn-sm danger' href='student_delete.php?id=<?php echo $id; ?>' onclick='return confirm("Hapus?")'>Hapus</a>
        </td>
      </tr>
<?php 
endwhile; 
$stmt->close(); 
?>
    </tbody>
  </table>
</section>

<script>
const searchInput = document.getElementById('tableSearch');
const table = document.getElementById('studentsTable').getElementsByTagName('tbody')[0];

searchInput.addEventListener('keyup', function() {
  const filter = this.value.toLowerCase();
  Array.from(table.rows).forEach(row => {
    const text = row.textContent.toLowerCase();
    row.style.display = text.includes(filter) ? '' : 'none';
  });
});
</script>

@endsection
