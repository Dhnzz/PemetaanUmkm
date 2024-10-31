<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, JenisUsahaController, UmkmController};

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('dashboard')->group(function(){
    Route::resource('jenis-usaha', JenisUsahaController::class);
    Route::resource('umkm', UmkmController::class);
});
