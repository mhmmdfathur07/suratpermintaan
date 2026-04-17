<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserLayananController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DoctorController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

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

    // DEBUG ROUTE - Hapus setelah selesai troubleshoot
    Route::get('/debug/layanan', function() {
        $all = \App\Models\Layanan::all();
        $aktif = \App\Models\Layanan::where('is_active', true)->get();
        
        return response()->json([
            'total_layanan' => $all->count(),
            'layanan_aktif' => $aktif->count(),
            'semua_layanan' => $all,
            'layanan_aktif_detail' => $aktif
        ]);
    });

    /* ===== ADMIN AREA ===== */
    Route::get('/permintaan', [PermintaanController::class, 'index'])->name('permintaan.index');
    Route::get('/permintaan/{id}/view', [PermintaanController::class, 'viewSurat'])->name('permintaan.view');
    Route::get('/permintaan/{id}/cetak', [PermintaanController::class, 'cetakSurat'])->name('permintaan.cetak');

    Route::get('/permintaan/{id}/edit', [PermintaanController::class, 'edit'])->name('permintaan.edit');
    Route::put('/permintaan/{id}', [PermintaanController::class, 'update'])->name('permintaan.update');
    Route::delete('/permintaan/{id}', [PermintaanController::class, 'destroy'])->name('permintaan.destroy');
    Route::patch('/permintaan/{id}/status', [PermintaanController::class, 'updateStatus'])->name('permintaan.updateStatus');
    Route::post('/permintaan/{id}/upload', [PermintaanController::class, 'uploadSurat'])->name('permintaan.upload');

    /* ===== MASTER LAYANAN ===== */
    Route::prefix('master/layanan')->name('master.layanan.')->group(function () {
        Route::get('/', [LayananController::class, 'index'])->name('index');
        Route::get('/create', [LayananController::class, 'create'])->name('create');
        Route::post('/', [LayananController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [LayananController::class, 'edit'])->name('edit');
        Route::put('/{id}', [LayananController::class, 'update'])->name('update');
        Route::delete('/{id}', [LayananController::class, 'destroy'])->name('destroy');
    });


    /* ===== MASTER USER (admin only) ===== */
    Route::prefix('master/user')->name('master.user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    /* ===== MASTER DOCTOR (admin only) ===== */
    Route::prefix('master/doctor')->name('master.doctor.')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->name('index');
        Route::post('/', [DoctorController::class, 'store'])->name('store');
        Route::put('/{id}', [DoctorController::class, 'update'])->name('update');
        Route::delete('/{id}', [DoctorController::class, 'destroy'])->name('destroy');
    });

    /* ===== MASTER EMPLOYEE (admin only) ===== */
    Route::prefix('master/employee')->name('master.employee.')->group(function () {
        Route::post('/', [EmployeeController::class, 'store'])->name('store');
        Route::put('/{id}', [EmployeeController::class, 'update'])->name('update');
        Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('destroy');
    });

    /* ===== MASTER ROLE (admin only) ===== */
    Route::prefix('master/role')->name('master.role.')->group(function () {
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::put('/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
    });

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