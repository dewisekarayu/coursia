<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseRegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Models\CourseRegistration;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\AdminInstructorController;
use App\Http\Controllers\Admin\AdminProgramController;
use App\Http\Controllers\Admin\AdminScheduleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminActivityLogController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\EnsureAdminRole;
use Illuminate\Support\Facades\DB;

// ==========================================
// 1. PUBLIC & STUDENT ROUTES
// ==========================================
Route::view('/', 'homepage')->name('home');
Route::get('/register', [AuthController::class, 'register'])->name('register.form');
Route::get('/login', [AuthController::class, 'login'])->name('login.form');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Pendaftaran Utama (Siswa)
Route::get('/daftar', [CourseRegistrationController::class, 'create'])->name('daftar');
Route::post('/daftar', [CourseRegistrationController::class, 'store'])->name('daftar.store');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/invoice', [InvoiceController::class, 'show'])->name('invoice');

// Allow GET requests to /invoice (redirect to dashboard) to avoid 405 on direct navigation
Route::get('/invoice', function () {
    return redirect()->route('dashboard');
})->name('invoice.redirect');

// Static page routes for legacy templates
Route::view('/homepage', 'homepage')->name('homepage');
Route::view('/kidsprogram', 'kidsprogram')->name('kidsprogram');
Route::view('/teensprogram', 'teensprogram')->name('teensprogram');
Route::view('/adultsprogram', 'adultsprogram')->name('adultsprogram');
Route::view('/mentor', 'mentor')->name('mentor');
Route::view('/pendapat', 'pendapat')->name('pendapat');
Route::view('/jadwalkelas', 'jadwalkelas')->name('jadwalkelas');

// Route payment student
Route::get('/payment', function () {
    return view('payment');
})->name('payment');

Route::post('/paid', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'course_registration_id' => 'required|integer',
        'invoice_code' => 'required|string',
        'harga' => 'required',
        'method' => 'required|string',
    ]);

    $user = \Illuminate\Support\Facades\Auth::user();
    $registration = \App\Models\CourseRegistration::where('user_id', $user->id)
        ->where('id', $request->input('course_registration_id'))
        ->firstOrFail();

    $amount = is_numeric($request->input('harga')) ? (float)$request->input('harga') : 0;

    \App\Models\Pembayaran::updateOrCreate(
        ['course_registration_id' => $registration->id],
        [
            'invoice_code' => $request->input('invoice_code'),
            'amount' => $amount,
            'payment_method' => $request->input('method'),
            'status' => 'lunas',
            'paid_at' => now(),
        ]
    );

    return redirect()->route('dashboard');
})->name('paid');

Route::resource('produk', App\Http\Controllers\ProdukController::class);


// ==========================================
// 2. ADMIN ROUTES (Eloquent + Session Group)
// ==========================================
Route::middleware(['web'])->group(function () {
    
    // Auth Admin
    Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login.form');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Dashboard Admin
    Route::get('/admin', [AdminDashboardController::class, 'index'])
        ->middleware(EnsureAdmin::class)
        ->name('admin.dashboard');

    // --- ROLE: ADMIN KEUANGAN | SUPERADMIN ---
    // Manajemen Pembayaran Admin
    Route::get('/admin/payments', [AdminPaymentController::class, 'index'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_keuangan|superadmin'])
        ->name('admin.payments');

    // --- ROLE: ADMIN KURSUS | SUPERADMIN ---
    // Manajemen Siswa (Students)
    Route::get('/admin/students', [AdminStudentController::class, 'index'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.students');

    Route::get('/admin/students/add', [AdminStudentController::class, 'create'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.students.add');

    Route::post('/admin/students/add', [AdminStudentController::class, 'store'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.students.store');

    Route::get('/admin/students/edit/{id}', function ($id) {
        return view('admin.student_edit_index', ['id' => $id]);
    })->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])->name('admin.students.edit');

    // Menampilkan halaman konfirmasi delete siswa (GET)
    Route::get('/admin/students/delete/{id}', function ($id) {
        $registration = CourseRegistration::find($id);
        
        // Cadangan: Jika tidak ada di tabel modern, cari di tabel pendaftaran legacy
        if (!$registration) {
            $registration = DB::table('pendaftaran')->where('id_pendaftaran', $id)->first();
            if ($registration) {
                // Standarisasi properti object agar view konfirmasi tidak error
                $registration->id = $registration->id_pendaftaran;
                $registration->name = $registration->nama ?? 'Siswa';
            }
        }
        
        if (!$registration) {
            abort(404, 'Data pendaftaran tidak ditemukan.');
        }

        return view('admin.student_delete_index', compact('registration'));
    })->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])->name('admin.students.delete');

    // Memproses aksi real delete dari database (DELETE) - FULL SINKRONISASI
    Route::delete('/admin/students/{id}', function ($id) {
        
        // 1. Bersihkan dari tabel Eloquent modern (course_registrations)
        $registration = CourseRegistration::find($id);
        if ($registration) {
            if ($registration->pembayaran) {
                $registration->pembayaran()->delete();
            }
            $registration->delete();
        }

        // 2. Bersihkan sisa data dari tabel database legacy secara manual
        DB::table('pembayaran')->where('course_registration_id', $id)->delete();
        DB::table('pendaftaran')->where('id_pendaftaran', $id)->delete();
        
        // FIX: Menggunakan kolom 'id_kursus' sebagai filter where clause
        DB::table('daftar_kursus')->where('id_kursus', $id)->delete();

        return redirect('/admin/students')->with('success', 'Pendaftaran kursus berhasil dihapus sepenuhnya dari sistem.');
    })->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])->name('admin.students.destroy');


    // Manajemen Instruktur (Instructors)
    Route::get('/admin/instructors', [AdminInstructorController::class, 'index'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.instructors');

    Route::get('/admin/instructors/add', [AdminInstructorController::class, 'create'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.instructors.add');

    Route::post('/admin/instructors', [AdminInstructorController::class, 'store'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.instructors.store');

    Route::get('/admin/instructors/{id}/edit', [AdminInstructorController::class, 'edit'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.instructors.edit');

    Route::put('/admin/instructors/{id}', [AdminInstructorController::class, 'update'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.instructors.update');

    // Menggunakan destroy bawaan controller instruktur
    Route::delete('/admin/instructors/{id}', [AdminInstructorController::class, 'destroy'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.instructors.destroy');

    // Manajemen Program
    Route::get('/admin/programs', [AdminProgramController::class, 'index'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.programs');

    // Tambah Program
    Route::get('/admin/programs/add', [AdminProgramController::class, 'create'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.programs.add');

    Route::post('/admin/programs', [AdminProgramController::class, 'store'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.programs.store');

    Route::get('/admin/programs/{id}/edit', [AdminProgramController::class, 'edit'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.programs.edit');

    Route::put('/admin/programs/{id}', [AdminProgramController::class, 'update'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.programs.update');

    Route::delete('/admin/programs/{id}', [AdminProgramController::class, 'destroy'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.programs.destroy');

    // Manajemen Jadwal (Schedules)
    Route::get('/admin/schedules', [AdminScheduleController::class, 'index'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.schedules');

    Route::get('/admin/schedules/add', [AdminScheduleController::class, 'create'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.schedules.add');

    Route::post('/admin/schedules', [AdminScheduleController::class, 'store'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.schedules.store');

    Route::get('/admin/schedules/{id}/edit', [AdminScheduleController::class, 'edit'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.schedules.edit');

    Route::put('/admin/schedules/{id}', [AdminScheduleController::class, 'update'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.schedules.update');

    Route::delete('/admin/schedules/{id}', [AdminScheduleController::class, 'destroy'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':admin_kursus|superadmin'])
        ->name('admin.schedules.destroy');


    // --- ROLE: ONLY SUPERADMIN ---
    // Manajemen Admin Akun
    Route::get('/admin/admins', [AdminUserController::class, 'index'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':superadmin'])
        ->name('admin.admins');

    Route::get('/admin/admins/add', [AdminUserController::class, 'create'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':superadmin'])
        ->name('admin.admins.add');

    Route::post('/admin/admins', [AdminUserController::class, 'store'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':superadmin'])
        ->name('admin.admins.store');

    Route::get('/admin/admins/{id}/edit', [AdminUserController::class, 'edit'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':superadmin'])
        ->name('admin.admins.edit');

    Route::put('/admin/admins/{id}', [AdminUserController::class, 'update'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':superadmin'])
        ->name('admin.admins.update');

    // Hapus Admin
    Route::delete('/admin/admins/{id}', [AdminUserController::class, 'destroy'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':superadmin'])
        ->name('admin.admins.destroy');

    // Activity Log
    Route::get('/admin/log', [AdminActivityLogController::class, 'index'])
        ->middleware([EnsureAdmin::class, EnsureAdminRole::class . ':superadmin'])
        ->name('admin.log');
});