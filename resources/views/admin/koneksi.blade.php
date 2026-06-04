<?php
// koneksi admin (legacy) tapi kredensial diambil dari environment Laravel
// supaya tidak hardcode host/user/pass/database.

$host = env('DB_HOST', '127.0.0.1');
$port = env('DB_PORT', '3306');
$user = env('DB_USERNAME', 'root');
$pass = env('DB_PASSWORD', '0000');
$db   = env('DB_DATABASE', 'coursia');

// catatan: mysqli mendukung parameter port via constructor
$conn = new mysqli($host, $user, $pass, $db, (int)$port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

if (!function_exists('log_activity')) {
    function log_activity($conn, $user_id, $aksi, $deskripsi = "") {
        $stmt = $conn->prepare(
            "INSERT INTO activity_log (user_id, aksi, deskripsi, ip_address) VALUES (?, ?, ?, ?)"
        );
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
        $stmt->bind_param("isss", $user_id, $aksi, $deskripsi, $ip);
        $stmt->execute();
    }
}
?>

