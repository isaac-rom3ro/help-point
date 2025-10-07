<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Company\LoginController;
use App\Http\Controllers\Company\RegisterController;
use App\Http\Controllers\Company\DashboardController;

Route::get('/', function () {
    return view('index');
});

// Naming -> resource.action.method
Route::prefix('company')->name('company.')->group(function () {

    Route::prefix('register')->name('register.')->group(function () {
        Route::get('/', [RegisterController::class, 'create'])->name('create');
        Route::post('/', [RegisterController::class, 'store'])->name('store');
    });

    Route::prefix('login')->name('login.')->group(function() {
        Route::get('/', [LoginController::class, 'showLoginForm'])->name('show');
        Route::post('/', [LoginController::class, 'login'])->name('login');
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });
});