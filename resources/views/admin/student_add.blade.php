@extends('admin.layout')

@section('content')
<?php 


$errors = [];

$programs = $conn->query("SELECT id_program, nama_program FROM program ORDER BY nama_program"); 
$users = $conn->query("SELECT id_user, email FROM user ORDER BY id_user DESC");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_user = intval($_POST['id_user']); 
    $nama    = trim($_POST['nama']); 
    $email   = trim($_POST['email']); 
    $hp      = trim($_POST['no_hp']); 
    $program = trim($_POST['program']); 
    $jadwal  = trim($_POST['jadwal']);

    if(!$nama) $errors[] = 'Nama wajib diisi'; 
    if(!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email tidak valid';

    if(empty($errors)){
        $ins = $conn->prepare("INSERT INTO daftar_kursus (id_user, nama, email, no_hp, program, jadwal) VALUES (?,?,?,?,?,?)"); 
        $ins->bind_param('isssss', $id_user, $nama, $email, $hp, $program, $jadwal); 
        $ins->execute(); 
        header('Location: students.php'); 
        exit;
    }
}
?>

<h1 class='page-title'>Tambah Pendaftaran Kursus</h1>
<section class='card'>
    <?php if($errors): ?>
        <div class='alert'>
            <?php echo implode('<br>', $errors); ?>
        </div>
    <?php endif; ?>

    <form method='post' class='form'>
        <label>User
            <select name='id_user'>
                <option value='0'>Pilih User</option>
                <?php while($u = $users->fetch_assoc()): ?>
                    <option value='<?php echo $u['id_user']; ?>'><?php echo htmlspecialchars($u['email']); ?></option>
                <?php endwhile; ?>
            </select>
        </label>

        <label>Nama
            <input name='nama' required>
        </label>

        <label>Email
            <input name='email' type='email' required>
        </label>

        <label>No HP
            <input name='no_hp'>
        </label>

        <label>Program
            <input name='program' list='programs'>
            <datalist id='programs'>
                <?php 
                $programs->data_seek(0); 
                while($p = $programs->fetch_assoc()): ?>
                    <option value='<?php echo htmlspecialchars($p['nama_program']); ?>'>
                <?php endwhile; ?>
            </datalist>
        </label>

        <label>Jadwal
            <input name='jadwal'>
        </label>

        <div class='form-actions'>
            <button class='btn' type='submit'>Simpan</button>
            <a class='btn ghost' href='students.php'>Batal</a>
        </div>
    </form>
</section>

@endsection
