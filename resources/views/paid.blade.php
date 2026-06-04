<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: payment.php");
    exit;
}

if (!isset($_SESSION['user_id'])) {
    die("Error: Sesi habis atau Anda belum login. Silakan login ulang.");
}

$invoice = $_POST['invoice'] ?? 'INV-ERROR';
$name    = $_POST['name'] ?? '-';
$email   = $_POST['email'] ?? '-';
$method  = $_POST['method'] ?? 'Transfer Bank';
$rawPrice = $_POST['harga'] ?? 0;

$harga = is_numeric($rawPrice) ? (float)$rawPrice : 0.0;

$id_pendaftaran = $_SESSION['user_id'];
$status         = 'Lunas';
$tanggal_bayar  = date('Y-m-d');

$stmt = $conn->prepare("INSERT INTO pembayaran (id_pendaftaran, jumlah, metode_pembayaran, status, tanggal_bayar) VALUES (?, ?, ?, ?, ?)");

if ($stmt) {
    $stmt->bind_param("idsss", $id_pendaftaran, $harga, $method, $status, $tanggal_bayar);
    
    if ($stmt->execute()) {
        
    } else {
         
    }
    $stmt->close();
} else {
     
}

$formattedHarga = 'Rp ' . number_format($harga, 0, ',', '.');
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pembayaran Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: #eef2f7; 
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-family: 'Segoe UI', sans-serif; 
        }
        
        .success-card {
            background: white;
            width: 100%;
            max-width: 450px;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.08);
            position: relative;
        }

        .check-icon-container {
            width: 80px;
            height: 80px;
            background: #d1fae5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            animation: popUp 0.5s ease-out;
        }
        .check-icon { 
            font-size: 40px; 
            color: #10b981; 
        }

        @keyframes popUp {
            0% { 
                transform: scale(0); 
                opacity: 0; 
            }
            80% { 
                transform: scale(1.1); 
            }
            100% { 
                transform: scale(1); 
                opacity: 1; 
            }
        }

        .title { 
            font-weight: 800; 
            color: #1f2937; 
            margin-bottom: 5px; 
        }
        .subtitle { 
            color: #6b7280; 
            font-size: 15px; 
            margin-bottom: 30px; 
        }

        .receipt-box {
            background: #f9fafb;
            border: 2px dashed #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            text-align: left;
        }

        .receipt-row { 
            display: flex; 
            justify-content: space-between; 
            margin-bottom: 10px; 
            font-size: 14px; 
            color: #4b5563; 
        }
        .receipt-row strong { 
            color: #111; 
        }
        .total-row { 
            border-top: 1px solid #ddd; 
            padding-top: 10px; 
            margin-top: 10px; 
            font-weight: 700; 
            color: #3652d1; 
            font-size: 18px; 
            display: flex; 
            justify-content: space-between; 
        }

        .btn-dashboard { 
            background: #3652d1; 
            color: white; 
            width: 100%; 
            padding: 12px; 
            border-radius: 10px; 
            border: none; 
            font-weight: 600; 
            margin-top: 25px; 
            transition: 0.3s; 
            text-decoration: none; 
            display: inline-block;
        }
        .btn-dashboard:hover { 
            background: #2a41b0; 
            color: white; 
        }
    </style>
</head>
<body>

    <div class="success-card">
        <div class="check-icon-container">
            <span class="check-icon">✓</span>
        </div>
        
        <h2 class="title">Pembayaran Sukses!</h2>
        <p class="subtitle">Data transaksi telah tersimpan di sistem.</p>

        <div class="receipt-box">
            <div class="receipt-row">
                <span>No. Invoice</span>
                <strong><?= htmlspecialchars($invoice) ?></strong>
            </div>
            <div class="receipt-row">
                <span>Nama</span>
                <strong><?= htmlspecialchars($name) ?></strong>
            </div>
            <div class="receipt-row">
                <span>Metode</span>
                <strong><?= htmlspecialchars($method) ?></strong>
            </div>
            <div class="total-row">
                <span>Total</span>
                <span><?= $formattedHarga ?></span>
            </div>
        </div>

        <a href="{{ route('dashboard') }}" class="btn-dashboard">Lihat Dashboard</a>
        
        <div class="mt-3">
            <a href="{{ route('home') }}" class="text-decoration-none text-muted small">Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>

