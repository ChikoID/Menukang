<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkerTypeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('landing.index');
});

Route::middleware(['guest'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'roles:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('worker-types', WorkerTypeController::class);
});

Route::middleware(['auth', 'roles:tukang'])->prefix('tukang')->name('tukang.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'tukang'])->name('dashboard');
});

Route::middleware(['auth', 'roles:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'pelanggan'])->name('dashboard');
});
