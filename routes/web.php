<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Sistem Inventaris Mobil Dinas
|--------------------------------------------------------------------------
*/

// ============================================================
// ROOT → LOGIN
// ============================================================
Route::get('/', fn () => redirect()->route('login'));

// ============================================================
// AUTH ROUTES
// ============================================================
Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============================================================
// PROTECTED ROUTES (butuh login)
// ============================================================
Route::middleware('auth.static')->group(function () {

    // ---------- Dashboard ----------
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // ---------- Mobil ----------
    Route::get('/mobil', [MobilController::class, 'index'])
        ->name('mobil.index');

    Route::get('/mobil/{mobil}', [MobilController::class, 'show'])
        ->name('mobil.show');

    // ---------- Peminjaman ----------
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])
        ->name('peminjaman.index');

    Route::get('/peminjaman/{peminjaman}', [PeminjamanController::class, 'show'])
        ->name('peminjaman.show');

    // ---------- Pengguna ----------
    Route::get('/pengguna', [UserController::class, 'index'])
        ->name('users.index');

    Route::post('/pengguna', [UserController::class, 'store'])
        ->name('users.store');

    Route::put('/pengguna/{user}', [UserController::class, 'update'])
        ->name('users.update');

    Route::post('/pengguna/{user}/reset-password', [UserController::class, 'resetPassword'])
        ->name('users.reset-password');

    Route::delete('/pengguna/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy');

    // ---------- Laporan ----------
    Route::prefix('laporan')->name('laporan.')->group(function () {

        Route::get('/', [LaporanController::class, 'index'])
            ->name('index');

        Route::get('/{pemakaian}', [LaporanController::class, 'show'])
            ->name('show');

        Route::get('/{pemakaian}/pdf', [LaporanController::class, 'exportPdf'])
            ->name('pdf');

        Route::get('/{pemakaian}/word', [LaporanController::class, 'exportWord'])
            ->name('word');
    });

}); 
