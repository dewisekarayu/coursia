@extends('admin.layout')

@section('content')
<?php 


$id = intval($_GET['id'] ?? 0);

$stmt = $conn->prepare("SELECT id_user, nama, email, no_hp, program, jadwal FROM daftar_kursus WHERE id_kursus=?"); 
$stmt->bind_param('i', $id); 
$stmt->execute(); 
$stmt->bind_result($id_user, $nama, $email, $hp, $program, $jadwal); 
$stmt->fetch(); 
$stmt->close();

$users = $conn->query("SELECT id_user, email FROM user ORDER BY id_user DESC");
$programs = $conn->query("SELECT id_program, nama_program FROM program ORDER BY nama_program");

if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
  $id_user2   = intval($_POST['id_user']); 
  $nama2      = trim($_POST['nama']); 
  $email2     = trim($_POST['email']); 
  $hp2        = trim($_POST['no_hp']); 
  $program2   = trim($_POST['program']); 
  $jadwal2    = trim($_POST['jadwal']); 

  $upd = $conn->prepare("UPDATE daftar_kursus SET id_user=?, nama=?, email=?, no_hp=?, program=?, jadwal=? WHERE id_kursus=?"); 
  $upd->bind_param('isssssi', $id_user2, $nama2, $email2, $hp2, $program2, $jadwal2, $id); 
  $upd->execute(); 

  header('Location: students.php'); 
  exit; 
}
?>

<h1 class='page-title'>Edit Pendaftaran Kursus</h1>
<section class='card'>
  <form method='post' class='form'>
    <label>User
      <select name='id_user'>
        <option value='0'>Pilih User</option>
        <?php while($u = $users->fetch_assoc()): 
          $sel = $u['id_user'] == $id_user ? 'selected' : ''; ?>
          <option value='<?php echo $u['id_user']; ?>' <?php echo $sel; ?>>
            <?php echo htmlspecialchars($u['email']); ?>
          </option>
        <?php endwhile; ?>
      </select>
    </label>

    <label>Nama
      <input name='nama' value='<?php echo htmlspecialchars($nama); ?>' required>
    </label>

    <label>Email
      <input name='email' type='email' value='<?php echo htmlspecialchars($email); ?>' required>
    </label>

    <label>No HP
      <input name='no_hp' value='<?php echo htmlspecialchars($hp); ?>'>
    </label>

    <label>Program
      <input name='program' value='<?php echo htmlspecialchars($program); ?>' list='programs'>
      <datalist id='programs'>
        <?php while($p = $programs->fetch_assoc()): ?>
          <option value='<?php echo htmlspecialchars($p['nama_program']); ?>'>
        <?php endwhile; ?>
      </datalist>
    </label>

    <label>Jadwal
      <input name='jadwal' value='<?php echo htmlspecialchars($jadwal); ?>'>
    </label>

    <div class='form-actions'>
      <button class='btn' type='submit'>Update</button>
      <a class='btn ghost' href='students.php'>Batal</a>
    </div>
  </form>
</section>

@endsection
