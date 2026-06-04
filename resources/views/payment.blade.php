@extends('components.layout')

@section('title', 'Pembayaran — Coursia')

@section('content')
<div class="container content-container">
    <div class="payment-wrapper">
        <div class="card payment-card border-0">
            
            @php
                $paket = request('paket');
                $mentor = request('mentor');

                $mentorNames = [
                    'anna' => 'Anna Williams',
                    'rizky' => 'Rizky Pratama',
                    'maya' => 'Maya Sari',
                    'john' => 'John Carter',
                ];

                $mentorDisplay = $mentorNames[$mentor] ?? '';
                $namaPaket = 'Paket Tidak Diketahui';
                $harga = 0;

                if ($paket === 'group') {
                    $namaPaket = 'Group Reguler';
                    $harga = 300000;
                } elseif ($paket === 'privat') {
                    $namaPaket = 'Privat One-on-One';
                    if (!empty($mentorDisplay)) {
                        $namaPaket .= ' w/ ' . $mentorDisplay;
                    }
                    $harga = 800000;
                } elseif ($paket === 'intensive') {
                    $namaPaket = 'Intensive TOEFL/IELTS';
                    $harga = 3000000;
                }
            @endphp

            {{-- Header Total Pembayaran --}}
            <div class="card-header-custom text-center">
                <span class="text-uppercase tracking-wider small opacity-75 mb-1 d-block fw-semibold" style="letter-spacing: 1px;">Total Pembayaran</span>
                <h1 class="price-tag mb-0" id="priceTag">Rp 0</h1>
            </div>

            {{-- Body Formulir --}}
            <div class="card-body p-4 p-md-5">
                <div class="summary-box mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <small class="text-muted d-block uppercase-label">Paket Pilihan</small>
                            <strong class="text-dark fs-5">{{ $namaPaket }}</strong>
                        </div>
                        <span class="badge badge-package">English Program</span>
                    </div>
                    @if(!empty($mentorDisplay))
                        <div class="mt-2 border-top pt-2">
                            <small class="text-muted">
                                <i class="bi bi-person-badge me-1"></i> Mentor Khusus: 
                                <span class="text-dark fw-medium">{{ $mentorDisplay }}</span>
                            </small>
                        </div>
                    @endif
                </div>

                <form action="{{ route('invoice') }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="course_registration_id" value="{{ request('course_registration_id') }}">
                    <input type="hidden" name="paket" value="{{ $namaPaket }}">
                    <input type="hidden" name="harga" value="{{ $harga }}">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap Siswa</label>
                        <input type="text" id="name" name="name" class="form-control custom-input" placeholder="Masukkan nama lengkap siswa" required value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Penerima Invoice</label>
                        <input type="email" id="email" name="email" class="form-control custom-input" placeholder="contoh@email.com" required value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="method" class="form-label">Metode Pembayaran</label>
                        <select id="method" name="method" class="form-select custom-select" required>
                            <option value="">-- Pilih Metode Pembayaran --</option>
                            <option value="QRIS" @selected(old('method')==='QRIS')>QRIS (GoPay / OVO / Dana)</option>
                            <option value="Transfer Bank" @selected(old('method')==='Transfer Bank')>Transfer Bank (BCA / Mandiri)</option>
                            <option value="Kartu Kredit" @selected(old('method')==='Kartu Kredit')>Kartu Kredit / Debit Online</option>
                        </select>
                        @error('method')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-pay w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                        <span>Konfirmasi & Bayar Sekarang</span>
                    </button>

                    <div class="text-center mt-3">
                        <small class="text-muted-custom">
                            🔒 Transaksi dienkripsi secara aman & rahasia
                        </small>
                    </div>
                </form>

                <div class="text-center mt-4 pt-2 border-top">
                    <a href="{{ route('home') }}" class="text-decoration-none btn-cancel text-muted small fw-medium">
                        ← Batalkan Transaksi & Kembali
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Solusi Utama: Memberikan margin atas yang cukup agar terlepas dari Navbar Fixed */
    .content-container {
        padding-top: 180px; 
        padding-bottom: 80px;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start; /* Menggunakan flex-start agar saat dilonggarkan tidak memotong layar atas */
    }

    /* Melebarkan ukuran box sedikit dari 400px-an ke 560px agar proporsional di desktop */
    .payment-wrapper {
        width: 100%;
        max-width: 560px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Card Styling */
    .payment-card { 
        background: #ffffff;
        border-radius: 24px; 
        box-shadow: 0 20px 40px rgba(54, 82, 209, 0.08), 0 1px 3px rgba(0, 0, 0, 0.02); 
        overflow: hidden; 
    }
    
    /* Header Solid Gradient */
    .card-header-custom { 
        background: linear-gradient(135deg, #3652d1 0%, #243bb0 100%); 
        color: white; 
        padding: 40px 25px; 
    }
    
    .price-tag { 
        font-size: 38px; 
        font-weight: 800; 
        letter-spacing: -0.5px;
    }
    
    /* Summary Container */
    .summary-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 18px 22px;
    }
    
    .uppercase-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
    }
    
    .badge-package {
        background-color: rgba(54, 82, 209, 0.1);
        color: #3652d1;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
    }

    /* Form Fields */
    .form-label { 
        font-weight: 600; 
        color: #334155; 
        font-size: 14px; 
        margin-bottom: 8px;
        display: inline-block;
    }
    
    .custom-input, .custom-select { 
        padding: 13px 16px; 
        border-radius: 12px; 
        border: 1.5px solid #e2e8f0; 
        font-size: 15px;
        color: #1e293b;
        background-color: #f8fafc;
        transition: all 0.25s ease;
    }
    
    .custom-input:focus, .custom-select:focus { 
        background-color: #ffffff;
        border-color: #3652d1; 
        box-shadow: 0 0 0 4px rgba(54, 82, 209, 0.12); 
        outline: none;
    }
    
    /* Button Action */
    .btn-pay { 
        background: #3652d1; 
        border: none; 
        font-weight: 600; 
        font-size: 16px;
        border-radius: 12px; 
        transition: all 0.3s ease; 
        box-shadow: 0 4px 12px rgba(54, 82, 209, 0.25);
    }
    
    .btn-pay:hover { 
        background: #243bb0; 
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(54, 82, 209, 0.35);
    }
    
    .text-muted-custom {
        color: #64748b;
        font-size: 12.5px;
    }
    
    .btn-cancel:hover {
        color: #3652d1 !important;
    }
    
    /* Responsivitas Layar Kecil / HP */
    @media (max-width: 576px) { 
        .content-container { padding-top: 130px; }
        .price-tag { font-size: 32px; } 
        .card-body { padding: 25px 20px !important; }
    }
</style>

<script>
    (function () {
        const priceTag = document.getElementById('priceTag');
        if (!priceTag) return;
        const raw = {{ (int)$harga }};
        const formatted = new Intl.NumberFormat('id-ID').format(raw);
        priceTag.textContent = `Rp ${formatted}`;
    })();
</script>
@endsection