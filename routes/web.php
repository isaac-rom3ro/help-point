<?php

use Illuminate\Support\Facades\Route;

// Company
use App\Services\Company\EmailService as CompanyEmailService;
use App\Http\Controllers\Company\LoginController as CompanyLoginController;
use App\Http\Controllers\Company\EmployeeController as CompanyEmployeeController;
use App\Http\Controllers\Company\RegisterController as CompanyRegisterController;
use App\Http\Controllers\Company\DashboardController as CompanyDashboardController;

// Employee
use App\Http\Controllers\Employee\LoginController as EmployeeLoginController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Employee\TimeLogController;

Route::get('/', function () {
    return view('index');
});

// Naming -> resource.action.method
Route::prefix('company')->name('company.')->group(function () {

    Route::prefix('register')->name('register.')->group(function () {
        Route::get('/', [CompanyRegisterController::class, 'create'])->name('create');
        Route::post('/', [CompanyRegisterController::class, 'store'])->name('store');
    });

    Route::prefix('login')->name('login.')->group(function() {
        Route::get('/', [CompanyLoginController::class, 'showLoginForm'])->name('show');
        Route::post('/', [CompanyLoginController::class, 'login'])->name('login');
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function() {
        Route::get('/', [CompanyDashboardController::class, 'index'])->name('dashboard');

        Route::prefix('employee')->name('employee.')->group(function () {
            Route::post('/', [CompanyEmployeeController::class, 'store'])->name('store');
            Route::post('/email', [CompanyEmailService::class, 'sendCredentialstoEmployee'])->name('send-credential-email');
        });
    });
}); 

Route::prefix('employee')->name('employee.')->group(function () {
    Route::prefix('login')->name('login.')->group(function () {
        Route::get('/', [EmployeeLoginController::class, 'create'])->name('create');
        Route::post('/', [EmployeeLoginController::class, 'login'])->name('login');

        Route::post('/password', [EmployeeLoginController::class, 'updatePassword'])->name('password');
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [EmployeeDashboardController::class, 'index'])->name('index');

        Route::prefix('time-log')->name('time-log.')->group(function (){
            Route::post('/', [TimeLogController::class, 'storeNewLog'])->name('store');
        });
    });
});