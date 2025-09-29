<?php

use App\Http\Controllers\company\RegisterController as CompanyRegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/register', [CompanyRegisterController::class, 'index'])->name('company.register.index');
Route::post('/register', [CompanyRegisterController::class, 'store'])->name('company.register.store');