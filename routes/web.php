<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, JenisUsahaController, UmkmController, AuthController};

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginProses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['authCheck'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('dashboard')->group(function(){
        Route::resource('jenis-usaha', JenisUsahaController::class);
        Route::resource('umkm', UmkmController::class);
    });
});
