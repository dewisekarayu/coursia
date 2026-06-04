@extends('components.layout')

@section('title', 'Dashboard — Coursia')

@section('content')
<div class="dashboard-wrapper py-5 mx-auto">
    <div class="container mx-auto">
        <div class="row justify-content-center mx-auto">
            <div class="col-12" style="max-width: 950px;">
                
                <div class="main-dashboard-card shadow-sm animate-fade-in">
                    
                    <div class="dashboard-header">
                        <h2 class="dashboard-title">Dashboard</h2>
                        <p class="dashboard-subtitle">
                            Hai, <span class="user-highlight">{{ $user->name ?? 'User' }}</span>. Ini ringkasan akun dan status kursusmu.
                        </p>
                    </div>

                    <div class="action-navigation">
                        <div class="nav-left-group">
                            <a href="{{ route('home') }}" class="btn btn-soft">Ke Beranda</a>
                            <a href="{{ route('daftar') }}" class="btn btn-soft">Daftar Kursus</a>
                        </div>
                        <a href="{{ route('logout') }}" class="btn btn-logout">Logout</a>
                    </div>

                    <div class="row g-4">
                        
                        <div class="col-md-5">
                            <div class="info-account-box">
                                <h4 class="box-title">Akun Saya</h4>
                                
                                <div class="info-list d-flex flex-column gap-3">
                                    <div class="info-item">
                                        <label>Email</label>
                                        <p class="info-value text-break">{{ $user->email }}</p>
                                    </div>
                                    <div class="info-item">
                                        <label>Jumlah Pendaftaran</label>
                                        <p class="info-value">{{ $registrations->count() }} Kursus</p>
                                    </div>
                                    <div class="info-item mb-0">
                                        <label>Status Kursus Terakhir</label>
                                        <div class="mt-1">
                                            <span class="status-badge-primary">
                                                {{ $registrations->first()?->status ?? 'Belum ada pendaftaran' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="history-table-box">
                                <h4 class="box-title">Riwayat Pendaftaran Kursus</h4>

                                @if($registrations->isEmpty())
                                    <div class="empty-state text-center py-4">
                                        <p class="mb-0">Kamu belum mendaftar kursus. Klik tombol "Daftar Kursus" untuk mulai.</p>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table custom-dashboard-table align-middle">
                                            <thead>
                                                <tr>
                                                    <th class="ps-3">Program</th>
                                                    <th>Jadwal</th>
                                                    <th>Status</th>
                                                    <th>Pembayaran</th>
                                                    <th>Aksi</th>
                                                    <th class="pe-3 text-end">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($registrations as $registration)
                                                    <tr>
                                                        <td class="ps-3 fw-semibold text-dark-blue">{{ $registration->program }}</td>
                                                        <td class="text-muted-blue">{{ $registration->jadwal }}</td>
                                                        <td>
                                                            <span class="status-badge-secondary">
                                                                {{ $registration->status }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @php
                                                                $payStatus = $registration->pembayaran?->status;
                                                            @endphp
                                                            <span class="status-badge-secondary">
                                                                {{ $payStatus ? ucfirst($payStatus) : 'Belum dibayar' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @if(!$registration->pembayaran || $registration->pembayaran->status !== 'lunas')
                                                                <a href="{{ route('payment', ['course_registration_id' => $registration->id]) }}" class="btn btn-soft" style="padding: 8px 14px;">
                                                                    Bayar
                                                                </a>
                                                            @else
                                                                <span class="status-badge-primary" style="font-size: 0.75rem;">Lunas</span>
                                                            @endif
                                                        </td>
                                                        <td class="pe-3 text-end text-muted-blue">
                                                            {{ $registration->created_at->format('d M Y') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div> </div> </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f3f7fa !important; 
    }

    /* Card Utama Dashboard */
    .main-dashboard-card {
        background-color: #ffffff;
        border-radius: 20px;
        padding: 40px;
        border: 1px solid rgba(220, 230, 242, 0.7);
        margin: 0 auto !important;
    }

    /* Header */
    .dashboard-header {
        border-bottom: 2px solid #f0f5fa;
        padding-bottom: 24px;
        margin-bottom: 28px;
    }
    .dashboard-title {
        font-weight: 800;
        color: #1e2d42;
        letter-spacing: -0.5px;
        margin-bottom: 6px;
    }
    .dashboard-subtitle {
        color: #65778b;
        margin-bottom: 0;
        font-size: 0.95rem;
    }
    .user-highlight {
        color: #2b70c9;
        font-weight: 700;
    }

    /* Area Navigasi / Tombol */
    .action-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 32px;
    }
    .nav-left-group {
        display: flex;
        gap: 10px;
    }

    /* Desain Tombol Soft Blue Navigasi */
    .btn-soft {
        background-color: #edf5fd;
        color: #2b70c9;
        font-weight: 700;
        font-size: 0.9rem;
        padding: 10px 20px;
        border-radius: 12px;
        border: 1px solid #d6e8fa;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
    }
    .btn-soft:hover {
        background-color: #e0effc;
        color: #1d5297;
        border-color: #bcd9f5;
    }

    /* Desain Tombol Logout */
    .btn-logout {
        background-color: #f7eff1;
        color: #c94b62;
        font-weight: 700;
        font-size: 0.9rem;
        padding: 10px 20px;
        border-radius: 12px;
        border: 1px solid #f5dee3;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
    }
    .btn-logout:hover {
        background-color: #f7e2e6;
        color: #9e3245;
        border-color: #ebaec0;
    }

    /* Kotak Judul Panel */
    .box-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e2d42;
        margin-bottom: 20px;
        letter-spacing: -0.2px;
    }
    
    /* Panel Info Kiri */
    .info-account-box {
        background-color: #f7fafc;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #edf2f7;
        height: 100%;
    }
    .info-item label {
        display: block;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #879ab0;
        font-weight: 700;
        margin-bottom: 4px;
    }
    .info-value {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0;
        font-size: 0.95rem;
    }

    /* Panel Tabel Kanan */
    .history-table-box {
        border: 1px solid #eef2f6;
        border-radius: 16px;
        padding: 24px;
        height: 100%;
        background-color: #ffffff;
    }
    .empty-state {
        color: #879ab0;
        font-size: 0.9rem;
    }

    /* Kustomisasi Tabel */
    .custom-dashboard-table {
        margin-bottom: 0;
        font-size: 0.88rem;
    }
    .custom-dashboard-table thead th {
        background-color: #f4f8fb;
        color: #65778b;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        border-bottom: none;
        padding: 12px 8px;
    }
    .custom-dashboard-table thead th:first-child {
        border-radius: 8px 0 0 8px;
    }
    .custom-dashboard-table thead th:last-child {
        border-radius: 0 8px 8px 0;
    }
    .custom-dashboard-table tbody tr td {
        padding: 16px 8px;
        border-bottom: 1px solid #f4f8fb;
    }
    .custom-dashboard-table tbody tr:last-child td {
        border-bottom: none;
    }
    .text-dark-blue {
        color: #2c3a4b;
    }
    .text-muted-blue {
        color: #7c8ba1;
    }

    /* Badge Status */
    .status-badge-primary {
        background-color: #2b70c9;
        color: #ffffff;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-block;
    }
    .status-badge-secondary {
        background-color: #eef5fc;
        color: #357ec7;
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid #dbe9f6;
    }

    /* Animasi */
    .animate-fade-in {
        animation: fadeIn 0.4s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection