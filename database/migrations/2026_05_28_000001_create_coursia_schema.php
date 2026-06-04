<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('admin')) {
        Schema::create('admin', function (Blueprint $table) {
            $table->integer('id_admin')->autoIncrement();
            $table->string('nama', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->enum('role', ['superadmin', 'admin_kursus', 'admin_keuangan']);
        }); }

        if (!Schema::hasTable('instruktur')) {
        Schema::create('instruktur', function (Blueprint $table) {
            $table->integer('Id_Instruktur')->autoIncrement();
            $table->string('Nama_Instruktur', 100)->nullable();
            $table->string('Pengalaman', 100)->nullable();
            $table->string('Level_Kelas', 50)->nullable();
        }); }

        if (!Schema::hasTable('user')) {
        Schema::create('user', function (Blueprint $table) {
            $table->integer('id_user')->autoIncrement();
            $table->string('email', 100)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('alamat', 255)->nullable();
        }); }

        if (!Schema::hasTable('daftar')) {
        Schema::create('daftar', function (Blueprint $table) {
            $table->integer('id_daftar')->autoIncrement();
            $table->string('nama', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('konfirmasi_password', 250)->nullable();
        }); }

        if (!Schema::hasTable('program')) {
        Schema::create('program', function (Blueprint $table) {
            $table->integer('id_program')->autoIncrement();
            $table->integer('id_instruktur')->nullable();
            $table->string('nama_program', 100);
            $table->text('deskripsi')->nullable();
            $table->string('level', 50)->nullable();
            $table->decimal('harga', 10, 2)->nullable();
            $table->string('durasi', 50)->nullable();
            $table->index('id_instruktur');
            $table->foreign('id_instruktur')->references('Id_Instruktur')->on('instruktur')->onDelete('set null');
        }); }

        if (!Schema::hasTable('activity_log')) {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id')->nullable();
            $table->string('aksi', 255);
            $table->text('deskripsi')->nullable();
            $table->string('ip_address', 50)->nullable();
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->index('user_id');
            $table->foreign('user_id')->references('id_user')->on('user')->onDelete('set null');
        }); }

        if (!Schema::hasTable('tb_login')) {
        Schema::create('tb_login', function (Blueprint $table) {
            $table->integer('kode_login')->autoIncrement();
            $table->integer('id_daftar')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('password', 250)->nullable();
            $table->index('id_daftar');
            $table->foreign('id_daftar')->references('id_daftar')->on('daftar');
        }); }

        if (!Schema::hasTable('daftar_kursus')) {
        Schema::create('daftar_kursus', function (Blueprint $table) {
            $table->integer('id_kursus')->autoIncrement();
            $table->integer('id_user');
            $table->string('program', 100)->nullable();
            $table->string('jadwal', 50)->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->index('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        }); }

        if (!Schema::hasTable('jadwal')) {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->integer('id_jadwal')->autoIncrement();
            $table->integer('id_program')->nullable();
            $table->string('hari', 50)->nullable();
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->index('id_program');
            $table->foreign('id_program')->references('id_program')->on('program')->onDelete('set null');
        }); }


        if (!Schema::hasTable('pendaftaran')) {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->integer('id_pendaftaran')->autoIncrement();
            $table->integer('id_user')->nullable();
            $table->integer('id_program')->nullable();
            $table->date('tanggal_daftar')->nullable();
            $table->string('status', 50)->nullable();
            $table->index('id_user');
            $table->index('id_program');
            $table->foreign('id_user')->references('id_user')->on('user');
            $table->foreign('id_program')->references('id_program')->on('program');
        }); }


        // Note: pembayaran table is created by migration 2026_06_01_000000_create_pembayaran_table
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('blankos');
        Schema::dropIfExists('pendaftaran');
        Schema::dropIfExists('jadwal');
        Schema::dropIfExists('daftar_kursus');
        Schema::dropIfExists('tb_login');
        Schema::dropIfExists('activity_log');
        Schema::dropIfExists('program');
        Schema::dropIfExists('daftar');
        Schema::dropIfExists('user');
        Schema::dropIfExists('instruktur');
        Schema::dropIfExists('admin');
    }
};
