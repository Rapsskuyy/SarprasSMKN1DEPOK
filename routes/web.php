<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;

Route::middleware('guest')->group(function () {
    // Redirect / and /login to /register for unified access
    Route::get('/login', function() { return redirect('/register'); })->name('login');
    
    Route::get('/register', [AuthController::class, 'index'])->name('register');
    Route::post('/register', [AuthController::class, 'access']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Siswa routes
    Route::middleware('can:siswa')->group(function () {
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('/siswa/pinjam/{id}', [SiswaController::class, 'createPinjam'])->name('siswa.pinjam.form');
        Route::post('/siswa/pinjam/{id}', [SiswaController::class, 'pinjam'])->name('siswa.pinjam');
    });

    // Admin routes
    Route::middleware('can:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/history', [AdminController::class, 'history'])->name('admin.history');
        Route::post('/admin/barang', [AdminController::class, 'store'])->name('admin.barang.store');
        Route::put('/admin/barang/{id}', [AdminController::class, 'update'])->name('admin.barang.update');
        Route::patch('/admin/barang/{id}/stock', [AdminController::class, 'updateStock'])->name('admin.barang.updateStock');
        Route::delete('/admin/barang/{id}', [AdminController::class, 'destroy'])->name('admin.barang.destroy');
        Route::post('/admin/peminjaman/{id}/kembali', [AdminController::class, 'returnItem'])->name('admin.peminjaman.kembali');
    });
});
