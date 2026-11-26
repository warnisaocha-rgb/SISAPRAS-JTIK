<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Halaman utama menampilkan Animasi Pembukaan (Portal Mahasiswa)
Route::get('/', [AuthController::class, 'showOpening'])->name('animasi.pembukaan');

// Alias rute animasi pembukaan
Route::get('/animasi-pembukaan', function () {
    return redirect()->route('animasi.pembukaan');
});

// Halaman Showcase Mockup Interaktif (untuk presentasi demo lokal)
Route::get('/mockup', function () {
    return view('mockup');
})->name('mockup');

Route::post('/mockup/switch-role', function (\Illuminate\Http\Request $request) {
    abort_unless(app()->environment('local'), 403);

    $role = $request->input('role', 'guest');
    $target = $request->input('target', '/');

    // Validasi path lokal aman (hanya rute internal aplikasi)
    $allowedTargets = [
        '/',
        '/login',
        '/petugas/login',
        '/petugas/register',
        '/mahasiswa/dashboard',
        '/mahasiswa/peminjaman/alat',
        '/mahasiswa/pengembalian',
        '/mahasiswa/status-pinjam',
        '/mahasiswa/bebas-sarpras',
        '/pengelola/dashboard',
        '/pengelola/pengembalian',
        '/pengelola/riwayat',
        '/pengelola/bebas-pinjam',
        '/admin/dashboard',
        '/admin/ruangan',
        '/admin/users',
    ];

    if (!in_array($target, $allowedTargets, true)) {
        $target = '/';
    }

    if ($role === 'guest') {
        \Illuminate\Support\Facades\Auth::logout();
    } elseif ($role === 'mahasiswa') {
        $user = \App\Models\User::where('nomor_induk', '250210500034')->first()
            ?? \App\Models\User::where('nomor_induk', '220209501012')->first()
            ?? \App\Models\User::where('role', 'mahasiswa')->first();
        if ($user) {
            \Illuminate\Support\Facades\Auth::login($user);
        }
    } elseif ($role === 'pengelola') {
        $user = \App\Models\User::where('email', 'pengelola.bengkel@unm.ac.id')->first()
            ?? \App\Models\User::where('role', 'pengelola')->where('status_akun', 'aktif')->first();
        if ($user) {
            \Illuminate\Support\Facades\Auth::login($user);
        }
    } elseif ($role === 'admin') {
        $user = \App\Models\User::where('role', 'admin')->first();
        if ($user) {
            \Illuminate\Support\Facades\Auth::login($user);
        }
    }

    return response()->json([
        'ok' => true,
        'target' => $target,
        'csrf_token' => csrf_token(),
    ]);
})->name('mockup.switch-role');

// Jalur Login Mahasiswa (Akun Terdaftar Database)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'loginMahasiswa'])->name('login.post');

// Jalur Login & Registrasi Terpisah khusus Pengelola & Admin
Route::get('/petugas/login', [AuthController::class, 'showStaffLogin'])->name('staff.login');
Route::post('/petugas/login', [AuthController::class, 'loginStaff'])->name('staff.login.post');
Route::get('/petugas/register', [AuthController::class, 'showPengelolaRegister'])->name('pengelola.register');
Route::post('/petugas/register', [AuthController::class, 'registerPengelola'])->name('pengelola.register.post');

// Jalur Lupa Kata Sandi Mandiri via Konfirmasi Email Pemilik Akun
Route::post('/password/forgot', [AuthController::class, 'sendPasswordResetLink'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Area Terautentikasi (Sesuai Role Pengguna / RBAC Ketat)
Route::middleware('auth')->group(function () {
    // Gateway Dashboard Otomatis sesuai Role saat Login
    Route::get('/dashboard', function () {
        return app(AuthController::class)->redirectSesuaiRole(auth()->user());
    })->name('dashboard');

    // Profil Pengguna, Perubahan Kata Sandi Mandiri & Monitoring Riwayat Login Pribadi (Semua Role)
    Route::post('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [DashboardController::class, 'updatePassword'])->name('profile.password');
    Route::get('/account/login-history', [DashboardController::class, 'myLoginHistory'])->name('account.login-history');

    // Layanan Khusus Role Mahasiswa
    Route::middleware('role:mahasiswa')->group(function () {
        Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
        Route::get('/mahasiswa/peminjaman', [DashboardController::class, 'mahasiswaPeminjamanAlat'])->name('mahasiswa.peminjaman');
        Route::get('/mahasiswa/peminjaman/alat', [DashboardController::class, 'mahasiswaPeminjamanAlat'])->name('mahasiswa.peminjaman.alat');
        Route::get('/mahasiswa/pengembalian', [DashboardController::class, 'mahasiswaPengembalian'])->name('mahasiswa.pengembalian');
        Route::get('/mahasiswa/status-pinjam', [DashboardController::class, 'mahasiswaStatusPinjam'])->name('mahasiswa.status-pinjam');
        Route::get('/mahasiswa/bebas-sarpras', [DashboardController::class, 'mahasiswaBebasSarpras'])->name('mahasiswa.bebas-sarpras');

        Route::post('/mahasiswa/peminjaman', [DashboardController::class, 'storeMahasiswaPeminjaman'])->name('mahasiswa.peminjaman.store');
        Route::post('/mahasiswa/peminjaman/batch', [DashboardController::class, 'storeMahasiswaPeminjamanBatch'])->name('mahasiswa.peminjaman.batch');
        Route::post('/mahasiswa/pengembalian', [DashboardController::class, 'storeMahasiswaPengembalian'])->name('mahasiswa.pengembalian.store');
        Route::delete('/mahasiswa/peminjaman/{id}/batal', [DashboardController::class, 'batalMahasiswaPeminjaman'])->name('mahasiswa.peminjaman.batal');
        Route::post('/mahasiswa/bebas-pinjam', [DashboardController::class, 'storeMahasiswaBebasPinjam'])->name('mahasiswa.bebas-pinjam.store');
        Route::patch('/mahasiswa/bebas-pinjam', [DashboardController::class, 'updateMahasiswaBebasPinjam'])->name('mahasiswa.bebas-pinjam.update');
        Route::delete('/mahasiswa/bebas-pinjam', [DashboardController::class, 'batalMahasiswaBebasPinjam'])->name('mahasiswa.bebas-pinjam.batal');
    });

    // Layanan Khusus Role Pengelola
    Route::middleware('role:pengelola')->group(function () {
        Route::get('/pengelola/dashboard', [DashboardController::class, 'pengelola'])->name('pengelola.dashboard');
        Route::get('/pengelola/riwayat', [DashboardController::class, 'pengelolaRiwayat'])->name('pengelola.riwayat');
        Route::get('/pengelola/pengembalian', [DashboardController::class, 'pengelolaPengembalian'])->name('pengelola.pengembalian');
        Route::post('/pengelola/pengembalian/{id}/verifikasi', [DashboardController::class, 'verifikasiPengembalian'])->name('pengelola.pengembalian.verifikasi');
        Route::post('/pengelola/pengembalian/{id}/tolak', [DashboardController::class, 'tolakPengembalian'])->name('pengelola.pengembalian.tolak');
        Route::get('/pengelola/bebas-pinjam', [DashboardController::class, 'pengelolaBebasPinjam'])->name('pengelola.bebas-pinjam');
        Route::post('/pengelola/bebas-pinjam/{id}/sahkan', [DashboardController::class, 'sahkanBebasPinjam'])->name('pengelola.bebas-pinjam.sahkan');
        Route::post('/pengelola/bebas-pinjam/{id}/tahan', [DashboardController::class, 'tahanBebasPinjam'])->name('pengelola.bebas-pinjam.tahan');
        Route::post('/pengelola/bebas-pinjam/{id}/lepas-tahan', [DashboardController::class, 'lepasTahanBebasPinjam'])->name('pengelola.bebas-pinjam.lepas-tahan');

        // Persetujuan & Penolakan Peminjaman oleh Pengelola (Per Item & Batch Per Tiket)
        Route::post('/pengelola/peminjaman/{id}/setujui', [DashboardController::class, 'setujuiPeminjaman'])->name('pengelola.peminjaman.setujui');
        Route::post('/pengelola/peminjaman/{id}/tolak', [DashboardController::class, 'tolakPeminjaman'])->name('pengelola.peminjaman.tolak');
        Route::post('/pengelola/peminjaman/tiket/{kode}/setujui', [DashboardController::class, 'setujuiPeminjamanTiket'])->name('pengelola.peminjaman.setujui-tiket');
        Route::post('/pengelola/peminjaman/tiket/{kode}/tolak', [DashboardController::class, 'tolakPeminjamanTiket'])->name('pengelola.peminjaman.tolak-tiket');
    });

    // Layanan Khusus Role Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

        // CRUD Sarpras oleh Admin
        Route::post('/admin/sarpras', [DashboardController::class, 'storeSarpras'])->name('admin.sarpras.store');
        Route::put('/admin/sarpras/{id}', [DashboardController::class, 'updateSarpras'])->name('admin.sarpras.update');
        Route::delete('/admin/sarpras/{id}', [DashboardController::class, 'destroySarpras'])->name('admin.sarpras.destroy');

        // Data Ruang & Lokasi (Master Data Ruangan) oleh Admin
        Route::get('/admin/ruangan', [DashboardController::class, 'ruanganIndex'])->name('admin.ruangan');
        Route::post('/admin/ruangan', [DashboardController::class, 'storeRuangan'])->name('admin.ruangan.store');
        Route::put('/admin/ruangan/{id}', [DashboardController::class, 'updateRuangan'])->name('admin.ruangan.update');
        Route::delete('/admin/ruangan/{id}', [DashboardController::class, 'destroyRuangan'])->name('admin.ruangan.destroy');

        // Persetujuan (ACC) Pendaftaran Pengelola, Aktivasi Status & Monitoring Riwayat Login Semua User
        // Catatan keamanan: Admin tidak dapat menambah akun mahasiswa/user manual, mengedit kredensial, maupun mereset sandi user.
        Route::get('/admin/users', [DashboardController::class, 'usersIndex'])->name('admin.users');
        Route::post('/admin/users/{id}/approve', [DashboardController::class, 'approvePengelola'])->name('admin.users.approve');
        Route::post('/admin/users/{id}/reject', [DashboardController::class, 'rejectPengelola'])->name('admin.users.reject');
        Route::post('/admin/users/{id}/toggle-status', [DashboardController::class, 'toggleUserStatus'])->name('admin.users.toggle-status');
    });
});
