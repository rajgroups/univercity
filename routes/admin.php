<?php

use App\Http\Controllers\auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\RegisterController;



Route::prefix('admin')->group(function(){
    Route::get('login',[LoginController::class,'showLoginForm'])->name('admin.login');

    // Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth.admin'])->group(function () {
        Route::get('change-password',[HomeController::class,'ChangePasswordForm'])->name('admin.password.change');
        Route::post('change-password',[HomeController::class,'ChangePassword'])->name('admin.password.update');
    });

});
