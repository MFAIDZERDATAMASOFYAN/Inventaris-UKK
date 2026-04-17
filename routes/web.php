<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('wellcome');

Route::middleware('isLogin')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginProses'])->name('loginProses');
});

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('checklogin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('isAdmin')->group(function () {
        Route::get('user', [UserController::class, 'index'])->name('user');
        Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
    });

    Route::get('user/create', [UserController::class, 'create'])->name('usercreate');
    Route::post('user/store', [UserController::class, 'store'])->name('userstore');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('useredit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('userupdate');
    Route::delete('user/destroy/{id}', [UserController::class, 'destroy'])->name('userdestroy');
    Route::get('user/excel', [UserController::class, 'excel'])->name('userexcel');
    Route::get('user/pdf', [UserController::class, 'pdf'])->name('userpdf');

    Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategoricreate');
    Route::post('kategori/store', [KategoriController::class, 'store'])->name('kategoristore');
    Route::get('kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategoriedit');
    Route::put('kategori/update/{id}', [KategoriController::class, 'update'])->name('kategoriupdate');
    Route::delete('kategori/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategoridestroy');
    Route::get('kategori/excel', [KategoriController::class, 'excel'])->name('kategoriexcel');
    Route::get('kategori/pdf', [KategoriController::class, 'pdf'])->name('kategoripdf');
    Route::get('/kategori/excel', [KategoriController::class, 'excel'])->name('kategoriexcel');
    Route::get('/kategori/pdf', [KategoriController::class, 'pdf'])->name('kategoripdf');

    Route::get('tugas', [TugasController::class, 'index'])->name('tugas');
    Route::get('tugas/create', [TugasController::class, 'create'])->name('tugascreate');
    Route::post('tugas/store', [TugasController::class, 'store'])->name('tugasstore');
    // Route::get('tugas/edit/{id}', [TugasController::class, 'edit'])->name('tugasedit');
    Route::get('/tugas/{id}/edit', [TugasController::class, 'edit'])->name('tugasedit');
    Route::put('/tugas/{id}', [TugasController::class, 'update'])->name('tugasupdate');
    Route::delete('/tugas/{id}', [TugasController::class, 'destroy'])->name('tugasdestroy');
    Route::post('/tugas/{id}/approve', [TugasController::class, 'approve'])->name('tugas.approve');
    Route::post('/tugas/{id}/reject', [TugasController::class, 'reject'])->name('tugas.reject');
    Route::post('/tugas/{id}/pinjam', [TugasController::class, 'pinjam'])->name('tugas.pinjam');
    Route::post('/tugas/{id}/kembali', [TugasController::class, 'kembali'])->name('tugas.kembali');
    Route::get('tugas/excel', [TugasController::class, 'excel'])->name('tugasexcel');
    Route::get('tugas/pdf', [TugasController::class, 'pdf'])->name('tugaspdf');
    Route::get('/tugas/detail/{id}', [TugasController::class, 'detail'])->name('tugasdetail');
});
