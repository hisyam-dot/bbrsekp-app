<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
->name('logout');

Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/desa/{detail}', [PublicController::class, 'show'])->name('public.desa.show');
Route::get('/tentang', [PublicController::class, 'tentang'])->name('public.tentang');

Route::middleware(['auth'])->group(function () {
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/desa/{detail}', [PegawaiController::class, 'show'])->name('pegawai.desa.show');
    Route::get('/pegawai/tentang', [PegawaiController::class, 'tentang'])->name('pegawai.tentang');
});

Route::get('/test-role', function () {
    return 'ROLE OK';
})->middleware(['auth', 'role:admin']);

require __DIR__.'/auth.php';
