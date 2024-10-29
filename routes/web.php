<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, JenisUsahaController};

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('dashboard')->group(function(){
    Route::prefix('/jenis-usaha')->group(function(){
        Route::get('/', [JenisUsahaController::class, 'index'])->name('jenis-usaha.index');
    });
});
