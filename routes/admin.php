<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SectorController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;



Route::prefix('admin')->as('admin.')->group(function() {
    Route::get('login',[LoginController::class,'showLoginForm'])->name('admin.login');

    // Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth.admin'])->group(function () {
        Route::get('change-password',[HomeController::class,'ChangePasswordForm'])->name('admin.password.change');
        Route::post('change-password',[HomeController::class,'ChangePassword'])->name('admin.password.update');

        // Dashboard Route
        Route::get('/dashboard', function(){
            return view('admin.home');
        })->name('home');
        // Category Routes
        Route::resource('category', CategoryController::class);

        // Sectors Routes
        Route::resource('sectors', SectorController::class);

        // Project Routes
        Route::resource('project', ProjectController::class);

        // Banner Routes
        Route::resource('banner',BannerController::class);

        // Announcement Routes
        Route::resource('announcement',AnnouncementController::class);

        // Course Resource Routes
        Route::resource('course',CourseController::class);

        // Blog Routes
        Route::resource('blog',BlogController::class);

        // Setting Home Page Settings Route
        Route::get('settings/home/edit',[SettingController::class,'editHomePage'])->name('setting.home.edit');
        Route::post('settings/home/update/{id}', [SettingController::class, 'homeUpdate'])->name('setting.home.update');

        // Setting Genral Settings
        Route::get('/settings/general/edit',[SettingController::class,'generalEdit'])->name('setting.general.edit');
        Route::post('/settings/general/update',[SettingController::class,'generalUpdate'])->name('setting.general.update');

        // For storing a new project
        Route::post('/projects', [App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('project.store');
        // For updating an existing project (assuming you have a route model binding)
        Route::put('/projects/{project}', [App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('project.update');
        // You'll also need routes for 'create' and 'edit' to display the form
        Route::get('/projects/create', [App\Http\Controllers\Admin\ProjectController::class, 'create'])->name('project.create');
        Route::get('/projects/{project}/edit', [App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('project.edit');
    });
});
