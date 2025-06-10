<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TopupController;

// Default redirect ke login
Route::get('/', function () {
    return redirect('/login');
});

// Dashboard - menampilkan data transaksi, jumlah user, dll
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Form Topup (tampilkan form)
Route::get('/topup', [TransactionController::class, 'create'])
    ->middleware('auth')
    ->name('topup.form');

// Proses Topup (simpan data)
Route::post('/topup', [TransactionController::class, 'store'])
    ->middleware('auth')
    ->name('topup.store');

// Login & Register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::post('/topup', [TopupController::class, 'store'])->name('topup.store');

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');
