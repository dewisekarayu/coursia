<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Login — Coursia</title>
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
            /* Latar belakang biru muda bersih (soft clean blue) sesuai Figma */
            background-color: #e3f2fd; 
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333333;
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }

        /* Card Putih Bersih dengan Rounded Corner Lembut & Shadow Halus */
        .login-card {
            background: #ffffff;
            padding: 45px 35px;
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
            margin-bottom: 25px;
        }

        .brand-logo img {
            height: 28px;
            object-fit: contain;
        }

        .login-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .login-header p {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
        }

        .form-input {
            width: 100%;
            padding: 13px 16px;
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

        /* Opsi Tambahan Form (Ingat Saya & Lupa Password) */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #4b5563;
            cursor: pointer;
        }

        .forgot-password {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        /* Tombol Utama Biru Cerah */
        .btn-login {
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
        }

        .btn-login:hover {
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
            width: 40%;
            height: 1px;
            background: #e5e7eb;
        }
        .divider::before { left: 0; }
        .divider::after { right: 0; }

        /* Tombol Media Sosial (Sesuai Desain Figma) */
        .social-group {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
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

        .login-footer {
            font-size: 14px;
            color: #4b5563;
        }

        .login-footer a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .alert-error {
            background: #fee2e2;
            color: #ef4444;
            padding: 12px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            border: 1px solid #fecaca;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        
        <a href="{{ route('home') }}" class="brand-logo">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3L1 9L12 15L21 10.09V17H23V9L12 3Z" fill="#1D4ED8"/>
                <path d="M5 13.18V17.18L12 21L19 17.18V13.18L12 17L5 13.18Z" fill="#1D4ED8"/>
            </svg>
            <span>Coursia</span>
        </a>
        
        <div class="login-header">
            <h2>LOGIN</h2>
            <p>Gunakan email & password untuk melanjutkan</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="email@domain.com" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">LOGIN</button>
        </form>

        <div class="login-footer">
            Belum punya akun? <a href="{{ route('register.form') }}">Daftar sekarang</a>
        </div>
    </div>
</div>

</body>
</html>