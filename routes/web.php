<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserLayananController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

// login page
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');

// login process
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (HARUS LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /* ===== ADMIN AREA ===== */
    Route::get('/permintaan', [PermintaanController::class, 'index'])->name('permintaan.index');
    Route::get('/permintaan/{id}/view', [PermintaanController::class, 'viewSurat'])->name('permintaan.view');
    Route::get('/permintaan/{id}/cetak', [PermintaanController::class, 'cetakSurat'])->name('permintaan.cetak');

    Route::get('/permintaan/{id}/edit', [PermintaanController::class, 'edit'])->name('permintaan.edit');
    Route::put('/permintaan/{id}', [PermintaanController::class, 'update'])->name('permintaan.update');
    Route::delete('/permintaan/{id}', [PermintaanController::class, 'destroy'])->name('permintaan.destroy');


    /* ===== USER AREA ===== */

    // Form pengajuan layanan
    Route::get('/layanan', [UserLayananController::class, 'index'])
        ->name('layanan.index');

    // Simpan permintaan user
    Route::post('/layanan', [UserLayananController::class, 'store'])
        ->name('layanan.store');

    // Dashboard user (lihat semua permintaan miliknya)
    Route::get('/user/permintaan', [UserLayananController::class, 'myRequests'])
        ->name('user.permintaan');

    // Detail progres permintaan
    Route::get('/user/permintaan/{id}', [UserLayananController::class, 'show'])
        ->name('user.permintaan.show');

    // Download surat jika sudah selesai
    Route::get('/user/permintaan/{id}/download', [UserLayananController::class, 'download'])
        ->name('user.permintaan.download');
});