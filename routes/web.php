<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KalapasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PemakaianController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

// ============================================================
// ROOT → LOGIN
// ============================================================
Route::get('/', fn() => redirect()->route('login'));

// ============================================================
// AUTH
// ============================================================
Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth.static')
    ->name('logout');

// ============================================================
// KALAPAS APPROVAL (PUBLIC — TANPA LOGIN)
// ============================================================
Route::prefix('persetujuan')->name('kalapas.')->group(function () {
    Route::get('/{token}',  [KalapasController::class, 'show'])->name('approval');
    Route::post('/{token}', [KalapasController::class, 'process'])->name('process');
});

// ============================================================
// PROTECTED
// ============================================================
Route::middleware('auth.static')->group(function () {

    // ============================================================
    // ADMIN ONLY
    // ============================================================
    Route::middleware('role:admin')->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Mobil — CRUD lengkap (admin only)
        Route::get('/mobil',            [MobilController::class, 'index'])->name('mobil.index');
        Route::post('/mobil',           [MobilController::class, 'store'])->name('mobil.store');
        Route::put('/mobil/{mobil}',    [MobilController::class, 'update'])->name('mobil.update');
        Route::delete('/mobil/{mobil}', [MobilController::class, 'destroy'])->name('mobil.destroy');

        // Peminjaman (admin)
        Route::get('/peminjaman',              [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/peminjaman/{peminjaman}', [PeminjamanController::class, 'show'])->name('peminjaman.show');

        // ============================================================
        // PEMAKAIAN — Approve / Reject / Kembalikan / Kirim WA Kalapas
        // ============================================================

        // Kembalikan pemakaian
        Route::post('/pemakaian/{pemakaian}/kembalikan', [PemakaianController::class, 'kembalikan'])
            ->name('pemakaian.kembalikan');

        // Approve / Reject pemakaian (tahap admin)
        Route::post('/pemakaian/{pemakaian}/approve', [PemakaianController::class, 'approve'])
            ->name('pemakaian.approve');
        Route::post('/pemakaian/{pemakaian}/reject', [PemakaianController::class, 'reject'])
            ->name('pemakaian.reject');

        // ✅ Kirim ulang link persetujuan ke Kalapas via WhatsApp
        Route::get('/pemakaian/{pemakaian}/kirim-wa-kalapas', [PemakaianController::class, 'kirimWaKalapas'])
            ->name('pemakaian.kirim-wa-kalapas');

        // Pengguna
        Route::get('/pengguna',                        [UserController::class, 'index'])->name('users.index');
        Route::post('/pengguna',                       [UserController::class, 'store'])->name('users.store');
        Route::put('/pengguna/{user}',                 [UserController::class, 'update'])->name('users.update');
        Route::post('/pengguna/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::delete('/pengguna/{user}',              [UserController::class, 'destroy'])->name('users.destroy');

        // Laporan
        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/',                 [LaporanController::class, 'index'])->name('index');
            Route::get('/{pemakaian}',      [LaporanController::class, 'show'])->name('show');
            Route::get('/{pemakaian}/pdf',  [LaporanController::class, 'exportPdf'])->name('pdf');
            Route::get('/{pemakaian}/word', [LaporanController::class, 'exportWord'])->name('word');
        });
    });

    // ============================================================
    // ADMIN & USER (accessible by both)
    // ============================================================

    // Lihat detail mobil — baik admin & user bisa
    Route::get('/mobil/{mobil}', [MobilController::class, 'show'])->name('mobil.show');

    // ============================================================
    // USER ONLY
    // ============================================================
    Route::middleware('role:user')->group(function () {

        // Dashboard User
        Route::get('/user', [UserDashboardController::class, 'index'])
            ->name('user.dashboard');

        // Katalog mobil untuk user
        Route::get('/user/katalog', [MobilController::class, 'katalog'])
            ->name('user.katalog');

        // Riwayat pemakaian user
        Route::get('/user/histori', [PemakaianController::class, 'histori'])
            ->name('user.histori');

        // Form pengajuan
        Route::get('/user/mobil/{mobil}/ajukan',  [PemakaianController::class, 'create'])
            ->name('user.pemakaian.create');
        Route::post('/user/mobil/{mobil}/ajukan', [PemakaianController::class, 'store'])
            ->name('user.pemakaian.store');
    });
});
