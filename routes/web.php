<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, JenisUsahaController, UmkmController, AuthController, PemilikController};

Route::middleware(['guest'])->group(function(){
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('loginProses');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('dashboard')->group(function () {
        Route::resource('jenis-usaha', JenisUsahaController::class);
        Route::resource('pemilik', PemilikController::class);
        Route::resource('umkm', UmkmController::class)->except(['create']);
        Route::get('/umkm/create/{pemilik}', [UmkmController::class, 'create'])->name('umkm.create');
        Route::get('/umkmPemilik/{pemilik}', [UmkmController::class, 'indexPemilik'])->name('umkm.indexPemilik');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
