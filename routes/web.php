<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TugasController;
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
    });

    Route::get('user/create', [UserController::class, 'create'])->name('usercreate');
    Route::post('user/store', [UserController::class, 'store'])->name('userstore');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('useredit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('userupdate');
    Route::delete('user/destroy/{id}', [UserController::class, 'destroy'])->name('userdestroy');
    Route::get('user/excel', [UserController::class, 'excel'])->name('userexcel');
    Route::get('user/pdf', [UserController::class, 'pdf'])->name('userpdf');

    Route::get('tugas', [TugasController::class, 'index'])->name('tugas');
    Route::get('tugas/create', [TugasController::class, 'create'])->name('tugascreate');
});




