@extends('components.layout')

@section('title', 'Daftar Kursus — Coursia')

@section('content')
<div class="container my-5 mx-auto">
    <div class="row justify-content-center mx-auto text-center">
        <div class="col-12 mx-auto" style="max-width: 600px; margin: 0 auto; float: none;">
            
            <div class="main-form-card shadow-sm">
                
                <div class="form-header text-center">
                    <h2 class="form-title">Daftar Program Kursus</h2>
                    <p class="form-subtitle">Isi form di bawah ini untuk memesan program kursus pilihanmu</p>
                </div>

                @if($errors->any())
                    <div class="custom-alert-error">
                        <div class="alert-icon">⚠️</div>
                        <div class="alert-messages-list">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('daftar.store') }}">
                    @csrf

                    <div class="form-group-item">
                        <label class="custom-form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="custom-form-input" required 
                               value="{{ old('nama', auth()->user()->name ?? '') }}" 
                               {{ auth()->check() ? 'readonly' : '' }}>
                    </div>

                    <div class="form-group-item">
                        <label class="custom-form-label">Alamat Email</label>
                        <input type="email" name="email" class="custom-form-input" required 
                               value="{{ old('email', auth()->user()->email ?? '') }}" 
                               {{ auth()->check() ? 'readonly' : '' }}>
                    </div>

                    <div class="form-group-item">
                        <label class="custom-form-label">No. Handphone</label>
                        <input type="tel" name="hp" class="custom-form-input" placeholder="Contoh: 08123456789" required value="{{ old('hp') }}">
                    </div>

                    <div class="form-group-item">
                        <label class="custom-form-label">Pilih Program Kursus</label>
                        @php
                            $prefProgram = request('program');
                        @endphp
                        <select name="program" class="custom-form-select" required>
                            <option value="">-- Pilih Program --</option>
                            <option value="Kids" @selected(old('program', $prefProgram)==='Kids')>English for Kids</option>
                            <option value="Teens" @selected(old('program', $prefProgram)==='Teens')>English for Teens</option>
                            <option value="Adults" @selected(old('program', $prefProgram)==='Adults')>English for Adults</option>
                        </select>
                    </div>

                    <div class="form-group-item">
                        <label class="custom-form-label">Pilih Jadwal Belajar</label>
                        @php
                            $prefJadwal = request('jadwal');
                        @endphp
                        <select name="jadwal" class="custom-form-select" required>
                            <option value="">-- Pilih Jadwal --</option>
                            <option value="Pagi" @selected(old('jadwal', $prefJadwal)==='Pagi')>Pagi</option>
                            <option value="Siang" @selected(old('jadwal', $prefJadwal)==='Siang')>Siang</option>
                            <option value="Malam" @selected(old('jadwal', $prefJadwal)==='Malam')>Malam</option>
                        </select>
                    </div>

                    <div class="form-action-group">
                        <a href="{{ route('dashboard') }}" class="btn btn-soft-back">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-soft-submit">
                            Daftar Sekarang <i class="bi bi-check-circle ms-2"></i>
                        </button>
                    </div>

                    <div class="form-footer-note">
                        <i class="bi bi-shield-check me-1"></i> Data pendaftaran akan disimpan dengan aman di sistem Coursia.
                    </div>
                </form>

            </div> </div>
    </div>
</div>

<style>
    body {
        background-color: #f3f7fa !important; 
    }

    /* Card Utama Form dipaksa ketengah dengan margin auto */
    .main-form-card {
        background-color: #ffffff;
        border-radius: 20px;
        padding: 40px;
        border: 1px solid rgba(220, 230, 242, 0.8);
        width: 100%;
        margin: 0 auto !important; /* Memaksa ke tengah */
        box-shadow: 0 10px 30px rgba(160, 180, 200, 0.15) !important;
    }

    /* Header Form */
    .form-header {
        border-bottom: 2px solid #f0f5fa;
        padding-bottom: 24px;
        margin-bottom: 28px;
        text-align: center;
    }
    .form-title {
        font-weight: 800;
        color: #1e2d42;
        letter-spacing: -0.5px;
        margin-bottom: 8px;
    }
    .form-subtitle {
        color: #65778b;
        margin-bottom: 0;
        font-size: 0.95rem;
    }

    .form-group-item {
        margin-bottom: 22px;
    }

    /* Label Input */
    .custom-form-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        color: #3a4d64;
        margin-bottom: 8px;
        text-align: left;
    }

    /* Input Teks & Select Option */
    .custom-form-input, 
    .custom-form-select {
        width: 100%;
        padding: 12px 16px;
        font-size: 0.95rem;
        font-weight: 500;
        color: #2c3e50;
        background-color: #fcfdff;
        border: 2px solid #e2eaf2;
        border-radius: 12px;
        outline: none;
        transition: all 0.2s ease-in-out;
    }

    .custom-form-input:focus, 
    .custom-form-select:focus {
        border-color: #9ac2f0;
        background-color: #ffffff;
        box-shadow: 0 0 0 4px rgba(43, 112, 201, 0.08);
    }



    /* Bagian Tombol Bawah */
    .form-action-group {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 32px;
        border-top: 2px solid #f0f5fa;
        padding-top: 24px;
    }

    .btn-soft-back {
        background-color: #f1f4f7;
        color: #5c6f84;
        font-weight: 700;
        font-size: 0.95rem;
        padding: 12px 24px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-soft-back:hover {
        background-color: #e6eaf0;
        color: #3a4d64;
        border-color: #cbd5e1;
    }

    .btn-soft-submit {
        background-color: #2b70c9;
        color: #ffffff;
        font-weight: 700;
        font-size: 0.95rem;
        padding: 12px 28px;
        border-radius: 12px;
        border: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease-in-out;
    }
    .btn-soft-submit:hover {
        background-color: #1d5297;
        color: #ffffff;
    }

    .form-footer-note {
        color: #a0aec0;
        font-size: 0.8rem;
        margin-top: 24px;
        text-align: center;
    }

    .custom-alert-error {
        background-color: #fdf2f4;
        border: 1px solid #f5dee3;
        border-radius: 12px;
        padding: 16px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 24px;
        color: #c94b62;
        font-size: 0.9rem;
        font-weight: 600;
    }
</style>
@endsection