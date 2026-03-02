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

// Register
Route::get('/register', [RegisteredUserController::class, 'create'])
->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
->name('register.store');

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
->name('logout');

// Forgot Password
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
->name('password.email');

// Reset Password
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
->name('password.update');

Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/desa/{desa}', [PublicController::class, 'show'])->name('public.desa.show');
Route::get('/tentang', [PublicController::class, 'tentang'])->name('public.tentang');

Route::middleware(['auth'])->group(function () {
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/desa/{desa}', [PegawaiController::class, 'show'])->name('pegawai.desa.show');
    Route::get('/pegawai/tentang', [PegawaiController::class, 'tentang'])->name('pegawai.tentang');
});

Route::get('/test-role', function () {
    return 'ROLE OK';
})->middleware(['auth', 'role:admin']);

require __DIR__.'/auth.php';
