<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CoursiaDatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     * Disesuaikan dengan konten homepage Coursia (program, pengajar, harga, testimoni).
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('admin')->truncate();
        DB::table('instruktur')->truncate();
        DB::table('user')->truncate();
        DB::table('daftar')->truncate();
        DB::table('program')->truncate();
        DB::table('activity_log')->truncate();
        DB::table('tb_login')->truncate();
        DB::table('daftar_kursus')->truncate();
        DB::table('jadwal')->truncate();
        DB::table('pendaftaran')->truncate();
        DB::table('course_registrations')->truncate();
        DB::table('pembayaran')->truncate();


        Schema::enableForeignKeyConstraints();

        // ─────────────────────────────────────────────
        // ADMIN
        // ─────────────────────────────────────────────
        DB::table('admin')->insert([
            [
                'id_admin'  => 1,
                'nama'      => 'Admin Utama',
                'email'     => 'admin@coursia.id',
                'password'  => Hash::make('coursia2025'),
                'role'      => 'superadmin',
            ],
        ]);

        // ─────────────────────────────────────────────
        // INSTRUKTUR
        // ─────────────────────────────────────────────
        DB::table('instruktur')->insert([
            [
                'Id_Instruktur'   => 1,
                'Nama_Instruktur' => 'Anna Williams',
                'Pengalaman'      => 'Mengajar Kids dan persiapan TOEFL/IELTS semua usia',
                'Level_Kelas'     => 'TOEFL/IELTS, Kids',
            ],
            [
                'Id_Instruktur'   => 2,
                'Nama_Instruktur' => 'Rizky Pratama',
                'Pengalaman'      => 'Mengajar Business English dan Teens',
                'Level_Kelas'     => 'Business English, Teens',
            ],
            [
                'Id_Instruktur'   => 3,
                'Nama_Instruktur' => 'Maya Sari',
                'Pengalaman'      => 'Spesialis IELTS untuk Adults dan Professionals',
                'Level_Kelas'     => 'IELTS, Adults & Professionals',
            ],
            [
                'Id_Instruktur'   => 4,
                'Nama_Instruktur' => 'John Carter',
                'Pengalaman'      => 'Native speaker, conversation coach untuk semua level',
                'Level_Kelas'     => 'Conversation, Adults',
            ],
        ]);

        // ─────────────────────────────────────────────
        // PROGRAM
        // ─────────────────────────────────────────────
        DB::table('program')->insert([
            [
                'id_program'    => 1,
                'id_instruktur' => 1,
                'nama_program'  => 'English for Kids',
                'deskripsi'     => 'Storytelling, songs, phonics, dan activities interaktif. Maksimal 8 siswa per kelas.',
                'level'         => 'Starter → Elementary',
                'harga'         => '250000.00',
                'durasi'        => '60 menit / sesi',
            ],
            [
                'id_program'    => 2,
                'id_instruktur' => 2,
                'nama_program'  => 'English for Teens',
                'deskripsi'     => 'Speaking, writing, presentation, dan persiapan ujian sekolah.',
                'level'         => 'Elementary → Pre-Intermediate',
                'harga'         => '300000.00',
                'durasi'        => '90 menit / sesi',
            ],
            [
                'id_program'    => 3,
                'id_instruktur' => 3,
                'nama_program'  => 'Adults & Professionals',
                'deskripsi'     => 'Business English, presentation, negotiation, dan exam prep.',
                'level'         => 'Intermediate → Advanced',
                'harga'         => '450000.00',
                'durasi'        => '90–120 menit / sesi',
            ],
            [
                'id_program'    => 4,
                'id_instruktur' => 1,
                'nama_program'  => 'TOEFL & IELTS Intensive',
                'deskripsi'     => 'Paket 8–12 minggu simulasi ujian, analisis hasil, dan feedback personal.',
                'level'         => 'Advanced',
                'harga'         => '3000000.00',
                'durasi'        => '8–12 minggu',
            ],
        ]);

        // ─────────────────────────────────────────────
        // JADWAL
        // ─────────────────────────────────────────────
        DB::table('jadwal')->insert([
            ['id_jadwal' => 1, 'id_program' => 1, 'hari' => 'Senin & Rabu',   'jam_mulai' => '16:00:00', 'jam_selesai' => '17:00:00', 'lokasi' => 'Online'],
            ['id_jadwal' => 2, 'id_program' => 1, 'hari' => 'Sabtu',          'jam_mulai' => '09:00:00', 'jam_selesai' => '10:00:00', 'lokasi' => 'Offline – Depok'],
            ['id_jadwal' => 3, 'id_program' => 2, 'hari' => 'Selasa & Kamis', 'jam_mulai' => '15:30:00', 'jam_selesai' => '17:00:00', 'lokasi' => 'Online'],
            ['id_jadwal' => 4, 'id_program' => 2, 'hari' => 'Sabtu',          'jam_mulai' => '10:30:00', 'jam_selesai' => '12:00:00', 'lokasi' => 'Offline – Jakarta'],
            ['id_jadwal' => 5, 'id_program' => 3, 'hari' => 'Senin & Rabu',   'jam_mulai' => '18:30:00', 'jam_selesai' => '20:00:00', 'lokasi' => 'Online'],
            ['id_jadwal' => 6, 'id_program' => 3, 'hari' => 'Sabtu',          'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'lokasi' => 'Offline – Surabaya'],
            ['id_jadwal' => 7, 'id_program' => 4, 'hari' => 'Senin – Jumat',  'jam_mulai' => '18:30:00', 'jam_selesai' => '20:30:00', 'lokasi' => 'Online'],
            ['id_jadwal' => 8, 'id_program' => 4, 'hari' => 'Sabtu',          'jam_mulai' => '07:00:00', 'jam_selesai' => '10:00:00', 'lokasi' => 'Offline – Depok'],
        ]);

        // ─────────────────────────────────────────────
        // USER (Detail Profil Murid)
        // ─────────────────────────────────────────────
        DB::table('user')->insert([
            ['id_user' => 1, 'email' => 'aulia@gmail.com', 'no_hp' => '08111100001', 'alamat' => 'Depok, Jawa Barat'],
            ['id_user' => 2, 'email' => 'raka@gmail.com',  'no_hp' => '08111100002', 'alamat' => 'Jakarta Selatan'],
            ['id_user' => 3, 'email' => 'maya@gmail.com',  'no_hp' => '08111100003', 'alamat' => 'Surabaya'],
            ['id_user' => 4, 'email' => 'rina@gmail.com',  'no_hp' => '08111100004', 'alamat' => 'Jakarta Timur'],
            ['id_user' => 5, 'email' => 'budi@gmail.com',  'no_hp' => '08111100005', 'alamat' => 'Bekasi, Jawa Barat'],
            ['id_user' => 6, 'email' => 'lala@gmail.com',  'no_hp' => '08199990000', 'alamat' => 'Jakarta'],
            ['id_user' => 9999, 'email' => 'guest@coursia.id', 'no_hp' => '0000000000', 'alamat' => 'Guest User'],
        ]);

        // ─────────────────────────────────────────────
        // DAFTAR (Akun Registrasi Murid)
        // ─────────────────────────────────────────────
        DB::table('daftar')->insert([
            ['id_daftar' => 1, 'nama' => 'Aulia Rahmawati', 'email' => 'aulia@gmail.com', 'password' => Hash::make('aulia2025'), 'konfirmasi_password' => Hash::make('aulia2025')],
            ['id_daftar' => 2, 'nama' => 'Raka Pratama',     'email' => 'raka@gmail.com',  'password' => Hash::make('raka2025'),  'konfirmasi_password' => Hash::make('raka2025')],
            ['id_daftar' => 3, 'nama' => 'Maya Putri',       'email' => 'maya@gmail.com',  'password' => Hash::make('maya2025'),  'konfirmasi_password' => Hash::make('maya2025')],
            ['id_daftar' => 4, 'nama' => 'Rina Sari',        'email' => 'rina@gmail.com',  'password' => Hash::make('rina2025'),  'konfirmasi_password' => Hash::make('rina2025')],
            ['id_daftar' => 5, 'nama' => 'Budi Santoso',     'email' => 'budi@gmail.com',  'password' => Hash::make('budi2025'),  'konfirmasi_password' => Hash::make('budi2025')],
            ['id_daftar' => 6, 'nama' => 'Lala Indah',       'email' => 'lala@gmail.com',  'password' => Hash::make('lala2025'),  'konfirmasi_password' => Hash::make('lala2025')],
        ]);

        // ─────────────────────────────────────────────
        // TB_LOGIN
        // ─────────────────────────────────────────────
        DB::table('tb_login')->insert([
            ['kode_login' => 1, 'id_daftar' => 1, 'email' => 'aulia@gmail.com', 'password' => Hash::make('aulia2025')],
            ['kode_login' => 2, 'id_daftar' => 2, 'email' => 'raka@gmail.com',  'password' => Hash::make('raka2025')],
            ['kode_login' => 3, 'id_daftar' => 3, 'email' => 'maya@gmail.com',  'password' => Hash::make('maya2025')],
            ['kode_login' => 4, 'id_daftar' => 4, 'email' => 'rina@gmail.com',  'password' => Hash::make('rina2025')],
            ['kode_login' => 5, 'id_daftar' => 5, 'email' => 'budi@gmail.com',  'password' => Hash::make('budi2025')],
            ['kode_login' => 6, 'id_daftar' => 6, 'email' => 'lala@gmail.com',  'password' => Hash::make('lala2025')],
        ]);

        // ─────────────────────────────────────────────
        // PENDAFTARAN KURSUS (Log internal)
        // ─────────────────────────────────────────────
        DB::table('pendaftaran')->insert([
            ['id_pendaftaran' => 1, 'id_user' => 1, 'id_program' => 1, 'tanggal_daftar' => '2025-09-01', 'status' => 'aktif'],
            ['id_pendaftaran' => 2, 'id_user' => 2, 'id_program' => 2, 'tanggal_daftar' => '2025-09-03', 'status' => 'aktif'],
            ['id_pendaftaran' => 3, 'id_user' => 3, 'id_program' => 3, 'tanggal_daftar' => '2025-09-05', 'status' => 'aktif'],
            ['id_pendaftaran' => 4, 'id_user' => 4, 'id_program' => 4, 'tanggal_daftar' => '2025-09-10', 'status' => 'aktif'],
            ['id_pendaftaran' => 5, 'id_user' => 5, 'id_program' => 4, 'tanggal_daftar' => '2025-09-10', 'status' => 'aktif'],
            ['id_pendaftaran' => 6, 'id_user' => 6, 'id_program' => 3, 'tanggal_daftar' => '2025-10-01', 'status' => 'pending'],
        ]);

        // ─────────────────────────────────────────────
        // DAFTAR KURSUS (Form publik lama/alternatif)
        // ─────────────────────────────────────────────
        DB::table('daftar_kursus')->insert([
            ['id_kursus' => 1, 'id_user' => 1, 'program' => 'English for Kids',         'jadwal' => '16:00', 'nama' => 'Aulia Rahmawati', 'email' => 'aulia@gmail.com', 'no_hp' => '08111100001'],
            ['id_kursus' => 2, 'id_user' => 2, 'program' => 'English for Teens',        'jadwal' => '15:30', 'nama' => 'Raka Pratama',    'email' => 'raka@gmail.com',  'no_hp' => '08111100002'],
            ['id_kursus' => 3, 'id_user' => 3, 'program' => 'Adults & Professionals',   'jadwal' => '18:30', 'nama' => 'Maya Putri',      'email' => 'maya@gmail.com',  'no_hp' => '08111100003'],
            ['id_kursus' => 4, 'id_user' => 4, 'program' => 'TOEFL & IELTS Intensive',  'jadwal' => '18:30', 'nama' => 'Rina Sari',       'email' => 'rina@gmail.com',  'no_hp' => '08111100004'],
            ['id_kursus' => 5, 'id_user' => 5, 'program' => 'TOEFL & IELTS Intensive',  'jadwal' => '18:30', 'nama' => 'Budi Santoso',     'email' => 'budi@gmail.com',  'no_hp' => '08111100005'],
            ['id_kursus' => 6, 'id_user' => 6, 'program' => 'Adults & Professionals',   'jadwal' => '18:30', 'nama' => 'Lala Indah',       'email' => 'lala@gmail.com',  'no_hp' => '08199990000'],
        ]);

        // ─────────────────────────────────────────────
        // COURSE REGISTRATIONS (Model Laravel ORM - Sinkron ID)
        // ─────────────────────────────────────────────
        DB::table('course_registrations')->insert([
            [
                'id'         => 1,
                'user_id'    => null, // Diubah menjadi null atau bisa disesuaikan dengan isi tabel users jika ada
                'name'       => 'Aulia Rahmawati',
                'email'      => 'aulia@gmail.com',
                'phone'      => '08111100001',
                'program'    => 'English for Kids',
                'jadwal'     => '16:00',
                'status'     => 'Terdaftar',
                'created_at' => '2025-09-01 09:00:00',
                'updated_at' => '2025-09-01 09:00:00',
            ],
            [
                'id'         => 2,
                'user_id'    => null,
                'name'       => 'Raka Pratama',
                'email'      => 'raka@gmail.com',
                'phone'      => '08111100002',
                'program'    => 'English for Teens',
                'jadwal'     => '15:30',
                'status'     => 'Terdaftar',
                'created_at' => '2025-09-03 10:00:00',
                'updated_at' => '2025-09-03 10:00:00',
            ],
            [
                'id'         => 3,
                'user_id'    => null,
                'name'       => 'Maya Putri',
                'email'      => 'maya@gmail.com',
                'phone'      => '08111100003',
                'program'    => 'Adults & Professionals',
                'jadwal'     => '18:30',
                'status'     => 'Terdaftar',
                'created_at' => '2025-09-05 08:00:00',
                'updated_at' => '2025-09-05 08:00:00',
            ],
            [
                'id'         => 4,
                'user_id'    => null,
                'name'       => 'Rina Sari',
                'email'      => 'rina@gmail.com',
                'phone'      => '08111100004',
                'program'    => 'TOEFL & IELTS Intensive',
                'jadwal'     => '18:30',
                'status'     => 'Terdaftar',
                'created_at' => '2025-09-10 11:00:00',
                'updated_at' => '2025-09-10 11:00:00',
            ],
            [
                'id'         => 5,
                'user_id'    => null,
                'name'       => 'Budi Santoso',
                'email'      => 'budi@gmail.com',
                'phone'      => '08111100005',
                'program'    => 'TOEFL & IELTS Intensive',
                'jadwal'     => '18:30',
                'status'     => 'Terdaftar',
                'created_at' => '2025-09-10 13:00:00',
                'updated_at' => '2025-09-10 13:00:00',
            ],
            [
                'id'         => 6,
                'user_id'    => null,
                'name'       => 'Lala Indah',
                'email'      => 'lala@gmail.com',
                'phone'      => '08199990000',
                'program'    => 'Adults & Professionals',
                'jadwal'     => '18:30',
                'status'     => 'Terdaftar',
                'created_at' => '2025-10-01 14:00:00',
                'updated_at' => '2025-10-01 14:00:00',
            ],
        ]);

        // ─────────────────────────────────────────────
        // PEMBAYARAN (Sinkron dengan Course Registrations & Harga Program)
        // ─────────────────────────────────────────────
        DB::table('pembayaran')->insert([
            [
                'course_registration_id' => 1, // Aulia Rahmawati
                'invoice_code'           => 'INV-2025-001',
                'amount'                 => 250000.00,   // English for Kids
                'payment_method'         => 'Transfer',
                'status'                 => 'lunas',
                'paid_at'                => '2025-09-01 10:00:00',
                'created_at'             => '2025-09-01 09:05:00',
                'updated_at'             => '2025-09-01 10:00:00',
            ],
            [
                'course_registration_id' => 2, // Raka Pratama
                'invoice_code'           => 'INV-2025-002',
                'amount'                 => 300000.00,   // English for Teens
                'payment_method'         => 'Transfer',
                'status'                 => 'lunas',
                'paid_at'                => '2025-09-03 11:00:00',
                'created_at'             => '2025-09-03 10:05:00',
                'updated_at'             => '2025-09-03 11:00:00',
            ],
            [
                'course_registration_id' => 3, // Maya Putri
                'invoice_code'           => 'INV-2025-003',
                'amount'                 => 450000.00,   // Adults & Professionals
                'payment_method'         => 'Transfer',
                'status'                 => 'lunas',
                'paid_at'                => '2025-09-05 09:30:00',
                'created_at'             => '2025-09-05 08:05:00',
                'updated_at'             => '2025-09-05 09:30:00',
            ],
            [
                'course_registration_id' => 4, // Rina Sari
                'invoice_code'           => 'INV-2025-004',
                'amount'                 => 3000000.00,  // TOEFL & IELTS Intensive
                'payment_method'         => 'Transfer',
                'status'                 => 'lunas',
                'paid_at'                => '2025-09-10 14:00:00',
                'created_at'             => '2025-09-10 11:05:00',
                'updated_at'             => '2025-09-10 14:00:00',
            ],
            [
                'course_registration_id' => 5, // Budi Santoso
                'invoice_code'           => 'INV-2025-005',
                'amount'                 => 3000000.00,  // TOEFL & IELTS Intensive
                'payment_method'         => 'Transfer',
                'status'                 => 'lunas',
                'paid_at'                => '2025-09-10 15:00:00',
                'created_at'             => '2025-09-10 13:05:00',
                'updated_at'             => '2025-09-10 15:00:00',
            ],
            [
                'course_registration_id' => 6, // Lala Indah
                'invoice_code'           => 'INV-2025-006',
                'amount'                 => 450000.00,   // Adults & Professionals
                'payment_method'         => 'Transfer',
                'status'                 => 'pending',
                'paid_at'                => null,
                'created_at'             => '2025-10-01 14:05:00',
                'updated_at'             => '2025-10-01 14:05:00',
            ],
        ]);


        // ─────────────────────────────────────────────
        // ACTIVITY LOG
        // ─────────────────────────────────────────────
        DB::table('activity_log')->insert([
            ['id' => 1, 'user_id' => 1, 'aksi' => 'Login',          'deskripsi' => 'Admin berhasil login',                                         'ip_address' => '::1', 'created_at' => '2025-10-01 08:00:00'],
            ['id' => 2, 'user_id' => 1, 'aksi' => 'Tambah Program', 'deskripsi' => 'Menambahkan program: English for Kids',        'ip_address' => '::1', 'created_at' => '2025-10-01 08:10:00'],
            ['id' => 3, 'user_id' => 1, 'aksi' => 'Tambah Program', 'deskripsi' => 'Menambahkan program: English for Teens',       'ip_address' => '::1', 'created_at' => '2025-10-01 08:15:00'],
            ['id' => 4, 'user_id' => 1, 'aksi' => 'Tambah Program', 'deskripsi' => 'Menambahkan program: Adults & Professionals',  'ip_address' => '::1', 'created_at' => '2025-10-01 08:20:00'],
            ['id' => 5, 'user_id' => 1, 'aksi' => 'Tambah Program', 'deskripsi' => 'Menambahkan program: TOEFL & IELTS Intensive', 'ip_address' => '::1', 'created_at' => '2025-10-01 08:25:00'],
            ['id' => 6, 'user_id' => 1, 'aksi' => 'Edit Program',    'deskripsi' => 'Mengubah harga program: TOEFL & IELTS Intensive menjadi Rp 3.000.000', 'ip_address' => '::1', 'created_at' => '2025-10-05 10:00:00'],
            ['id' => 7, 'user_id' => 1, 'aksi' => 'Logout',          'deskripsi' => 'Admin logout dari sistem',                     'ip_address' => '::1', 'created_at' => '2025-10-05 17:00:00'],
        ]);
    }
}