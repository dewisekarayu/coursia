<?php
include 'koneksi.php';

$default_password = 'admin123';
$email = 'admin@coursia.id';

$hashed_password = password_hash($default_password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE admin SET password = ? WHERE email = ?");
$stmt->bind_param('ss', $hashed_password, $email);

if ($stmt->execute()) {
    echo "<h2>Setup Berhasil!</h2>";
    echo "<p>Password admin telah di-set.</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Password:</strong> $default_password</p>";
    echo "<p style='color: red;'><strong>PENTING: Hapus file ini setelah digunakan untuk keamanan!</strong></p>";
} else {
    echo "<h2>Error!</h2>";
    echo "<p>Gagal setup password: " . htmlspecialchars($stmt->error) . "</p>";
}

$stmt->close();
$conn->close();
?>
