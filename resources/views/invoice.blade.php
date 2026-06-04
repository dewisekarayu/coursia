<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: payment.php");
    exit;
}

$paket  = $_POST['paket'];
$harga  = $_POST['harga'];
$name   = $_POST['name'];
$email  = $_POST['email'];
$method = $_POST['method'];

$invoiceCode = "INV-" . date("ymd") . "-" . rand(100, 999);
$tanggal = date("d F Y");
$expiryTime = date("H:i", strtotime("+24 hours"));
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tagihan #<?= $invoiceCode ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background: #f3f6ff;
            font-family: 'Segoe UI', sans-serif;
        }
        .invoice-card {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .top-section {
            padding: 30px;
            border-bottom: 2px dashed #eef1f5;
        }
        .bottom-section {
            padding: 30px;
            background: #fafbfc;
        }
        
        .amount-display {
            font-size: 32px;
            font-weight: 800;
            color: #2e47b8;
            margin: 10px 0;
        }
        .status-badge {
            background: #fff4e5;
            color: #ff9800;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            display: inline-block;
        }
        
        .payment-area {
            background: #fff;
            border: 1px solid #e0e6ed;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            text-align: center;
        }

        .qr-img {
            max-width: 200px;
            margin: 0 auto;
            display: block;
        }
        
        .rek-box {
            font-size: 20px;
            font-family: monospace;
            font-weight: bold;
            background: #eee;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0;
            letter-spacing: 2px;
        }
        .copy-btn {
            cursor: pointer;
            color: #2e47b8;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: block;
            margin-top: 5px;
        }

        .btn-confirm {
            background: #2e47b8;
            color: white;
            width: 100%;
            padding: 15px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            margin-top: 20px;
            transition: 0.3s;
        }
        .btn-confirm:hover {
            background: #23399b;
        }

        .cc-sim input {
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            width: 100%;
            border-radius: 6px;
        }

        .invoice-details-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            margin-top: 20px;
            text-align: left;
        }
        .invoice-details-grid > div {
            border: 1px solid #f0f0f0;
            padding: 10px 15px;
            border-radius: 8px;
        }

        .payment-area strong {
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="invoice-card">
        
        <div class="top-section text-center">
            <div class="status-badge"><i class="far fa-clock"></i> Menunggu Pembayaran</div>
            <div class="mt-3 text-muted">Total Tagihan</div>
            <div class="amount-display">Rp <?= number_format($harga, 0, ',', '.') ?></div>
            <p class="text-muted small">Batas pembayaran: Besok, jam <?= $expiryTime ?></p>
            
            <div class="invoice-details-grid px-4">
                <div>
                    <small class="text-muted">Order ID</small><br>
                    <strong><?= $invoiceCode ?></strong>
                </div>
                <div>
                    <small class="text-muted">Paket</small><br>
                    <strong><?= $paket ?></strong>
                </div>
            </div>
        </div>

        <div class="bottom-section">
            <h5 class="mb-3"><i class="fas fa-wallet"></i> Instruksi Pembayaran</h5>
            
            <?php if ($method === 'QRIS'): ?>
                
                <div class="payment-area">
                    <p class="mb-2">Scan QR code ini dengan GoPay, OVO, Dana, atau BCA Mobile:</p>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PembayaranCoursia-<?= $invoiceCode ?>" class="qr-img" alt="QRIS">
                    <small class="text-muted d-block mt-2">NMID: ID10200399420</small>
                </div>

            <?php elseif ($method === 'Transfer Bank'): ?>

                <div class="payment-area text-start">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" height="30" alt="BCA" class="me-2">
                        <strong>Bank BCA (Pengecekan Otomatis)</strong>
                    </div>
                    <small class="text-muted">Nomor Rekening:</small>
                    <div class="rek-box">8200 1234 5678</div>
                    <div class="text-end"><span class="copy-btn" onclick="alert('Nomor rekening disalin!')"><i class="far fa-copy"></i> Salin Nomor</span></div>
                    
                    <hr>
                    <div class="alert alert-info small mt-2">
                        <i class="fas fa-info-circle"></i> Mohon transfer tepat hingga 3 digit terakhir untuk verifikasi otomatis.
                    </div>
                </div>

            <?php elseif ($method === 'Kartu Kredit'): ?>

                <div class="payment-area cc-sim text-start">
                    <div class="mb-3">
                        <strong>Detail Kartu</strong>
                        <div class="text-muted"><i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i></div>
                    </div>
                    <input type="text" placeholder="Nomor Kartu (0000 0000 0000 0000)">
                    <div class="row">
                        <div class="col-12"><input type="text" placeholder="MM / YY"></div>
                        <div class="col-12"><input type="text" placeholder="CVV"></div>
                    </div>
                    <input type="text" value="<?= $name ?>" readonly style="background: #f9f9f9;">
                </div>

            <?php endif; ?>


            <form action="{{ route('paid') }}" method="POST">
                @csrf
                <input type="hidden" name="course_registration_id" value="<?= $course_registration_id ?? ($course_registration_id ?? '') ?>">
                <input type="hidden" name="invoice_code" value="<?= $invoiceCode ?>">
                <input type="hidden" name="harga" value="<?= $harga ?>">
                <input type="hidden" name="method" value="<?= $method ?>">

                <button type="submit" class="btn-confirm">
                    <?php echo ($method === 'Kartu Kredit') ? 'Proses Pembayaran' : 'Saya Sudah Bayar'; ?>
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>