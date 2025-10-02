<?php

use App\Http\Controllers\Company\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\RegisterController;

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
    });

});