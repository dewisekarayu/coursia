<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$nama = $_SESSION['nama'];
$email = $_SESSION['email'];
$tanggal = date("d M Y – H:i");
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Success</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --accent: #2e47b8;
      --bg: #f3f6ff;
      --card: #ffffff;
    }

    body {
      background: var(--bg);
      font-family: Inter, system-ui, sans-serif;
      color: #222;
      padding: 40px 0;
    }

    .success-box {
      max-width: 520px;
      margin: auto;
      background: var(--card);
      border-radius: 20px;
      padding: 40px;
      text-align: center;
      border: 1px solid #e4e8ff;
      box-shadow: 0 12px 30px rgba(0,0,0,0.05);
    }

    .title {
      font-size: 32px;
      font-weight: 800;
      color: var(--accent);
      margin-bottom: 14px;
    }

    .subtitle {
      font-size: 16px;
      color: #6e7186;
      margin-bottom: 32px;
      line-height: 1.5;
    }

    .btn-main {
      background: var(--accent);
      color: #fff;
      padding: 14px 28px;
      border-radius: 50px;
      font-weight: 600;
      font-size: 17px;
      border: none;
      transition: 0.2s;
    }

    .btn-main:hover {
      opacity: 0.9;
    }

    .details-box {
      margin-top: 26px;
      background: #f6f7ff;
      border-radius: 14px;
      padding: 18px 20px;
      text-align: left;
      font-size: 15px;
      color: #444;
      border: 1px solid #e6e8fb;
    }

    .details-box strong {
      color: var(--accent);
    }
  </style>
</head>
<body>

<div class="container">

  <div class="success-box">

    <h1 class="title">Pendaftaran Berhasil</h1>
    <p class="subtitle">
      Terima kasih! Pendaftaran Anda telah berhasil.  
      Silakan cek email Anda untuk informasi selanjutnya.
    </p>

    <a href="dashboard.php" class="btn-main">Ke Dashboard</a>

    <div class="details-box mt-4">
      <div><strong>Nama:</strong> <?= htmlspecialchars($nama) ?></div>
      <div><strong>Email:</strong> <?= htmlspecialchars($email) ?></div>
      <div><strong>Paket:</strong> English for Teens</div>
      <div><strong>Status:</strong> Berhasil</div>
      <div><strong>Waktu:</strong> <?= $tanggal ?></div>
    </div>

  </div>

</div>

</body>
</html>
