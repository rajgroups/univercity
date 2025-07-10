<?php
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\web\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

include(base_path('routes/admin.php'));

Route::get('/all-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
   //  Artisan::call('optimize');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
   //  Artisan::call('optimize');
   return "All cleared successfully";
});

// language
Route::get('password-hash', function () {
    return Hash::make('admin');
});

Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('registerform');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/about', function () {
    return view('web.about');
})->name('about');

Route::get('/course', function () {
    return view('web.course');
})->name('course');

Route::get('/coursemode', function () {
    return view('web.coursemode');
})->name('coursemode');

Route::get('/coursedetail', function () {
    return view('web.coursedetail');
})->name('coursedetail');

Route::get('/contact', function () {
    return view('web.contact');
})->name('contact');

Route::get('/programe', function () {
    return view('web.programe');
})->name('programe');

Route::get('/scheme', function () {
    return view('web.scheme');
})->name('scheme');

Route::get('/event', function () {
    return view('web.event');
})->name('event');
