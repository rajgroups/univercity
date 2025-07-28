<?php
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\web\RegisterController;
use App\Http\Controllers\Web\WebController;

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

// Web Routes
Route::get('/',[WebController::class,'home']);
// Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('registerform');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/about', function () {
    return view('web.about');
})->name('about');

Route::get('/course', function () {
    return view('web.course');
})->name('course');

// Route::get('/coursemode', function () {
//     return view('web.coursemode');
// })->name('coursemode');

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

    // Program Route
    Route::get('/program/{category}/{slug}',[WebController::class,'program'])->name('web.announcement.program');

    // scheme Route
    Route::get('/scheme/{category}/{slug}',[WebController::class,'scheme'])->name('web.announcement.scheme');

    // upcoming-project  Route
    Route::get('/upcoming-project/{category}/{slug}',[WebController::class,'upcoming'])->name('web.upcoming.project');

    // ongoing-project  Route
    Route::get('/ongoing-project/{category}/{slug}',[WebController::class,'ongoing'])->name('web.ongoging.project');

    // Sector Routes
    Route::get('/sector',[WebController::class,'sectors'])->name('web.sector');

    // Course Routes
    Route::get('/course',[WebController::class,'course'])->name('web.course.index');
    Route::get('/course/{slug}',[WebController::class,'courseDetails'])->name('web.course.show');

    // For catelog (Program,scheme,upcoming-project,ongoing-project)
    Route::get('/catalog', [WebController::class, 'catalog'])->name('web.catalog');

    // For Blog Catelog
    Route::get('/blogs', [WebController::class, 'blog'])->name('web.blog.filter');
    Route::get('/blogs/{slug}', [WebController::class, 'show'])->name('web.blog.show');
