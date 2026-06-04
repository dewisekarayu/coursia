<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Register — Coursia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #e3f2fd; /* Biru muda bersih sesuai Figma */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333333;
            padding: 30px 20px;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 440px;
        }

        /* Card Putih Bersih Eksklusif */
        .register-card {
            background: #ffffff;
            padding: 40px 35px;
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(54, 82, 209, 0.08);
            text-align: center;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 24px;
            font-weight: 700;
            color: #1e3a8a;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .page-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 16px;
            text-align: left;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 15px;
            color: #1f2937;
            font-family: inherit;
            transition: all 0.2s ease;
            outline: none;
            background-color: #ffffff;
        }

        .form-input:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 4px rgba(29, 78, 216, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        /* Tombol Utama Biru Cerah */
        .btn-register {
            width: 100%;
            padding: 14px;
            background: #1d4ed8;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 8px;
        }

        .btn-register:hover {
            background: #1e40af;
        }

        /* Pembatas Atau */
        .divider {
            margin: 20px 0;
            font-size: 13px;
            color: #9ca3af;
            position: relative;
        }
        .divider::before, .divider::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 35%;
            height: 1px;
            background: #e5e7eb;
        }
        .divider::before { left: 0; }
        .divider::after { right: 0; }

        /* Tombol Media Sosial */
        .social-group {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }

        .btn-social {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #ffffff;
            font-size: 14px;
            font-weight: 500;
            color: #4b5563;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-social:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .btn-social img {
            width: 18px;
            height: 18px;
        }

        .register-footer {
            font-size: 14px;
            color: #4b5563;
        }

        .register-footer a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }

        .back-link {
            display: inline-block;
            margin-top: 15px;
            font-size: 13px;
            color: #6b7280;
            text-decoration: none;
        }

        .back-link:hover {
            color: #1d4ed8;
        }

        .alert-error-box {
            background: #fee2e2;
            color: #ef4444;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            border: 1px solid #fecaca;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <div class="register-card">
        
        <a href="{{ route('home') }}" class="brand-logo">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3L1 9L12 15L21 10.09V17H23V9L12 3Z" fill="#1D4ED8"/>
                <path d="M5 13.18V17.18L12 21L19 17.18V13.18L12 17L5 13.18Z" fill="#1D4ED8"/>
            </svg>
            <span>Coursia</span>
        </a>

        <div class="page-header">
            <h2>DAFTAR AKUN</h2>
            <p>Gunakan data asli Anda untuk membuat akun baru</p>
        </div>

        @if($errors->any())
            <div class="alert-error-box">
                <div style="font-weight: 600; margin-bottom: 4px;">⚠️ Registrasi Gagal:</div>
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="name">Nama Lengkap</label>
                <input id="name" type="text" name="name" class="form-input" placeholder="Nama lengkap Anda" required value="{{ old('name') }}" autofocus>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input id="email" type="email" name="email" class="form-input" placeholder="email@domain.com" required value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input id="password" type="password" name="password" class="form-input" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-input" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-register">DAFTAR SEKARANG</button>
        </form>

        <div class="register-footer">
            Sudah punya akun? <a href="{{ route('login.form') }}">Masuk di sini</a>
        </div>

        <a href="{{ route('home') }}" class="back-link">← Kembali ke Beranda</a>
    </div>
</div>

</body>
</html>