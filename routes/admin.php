<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\IntlCourseController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SurveyController;
use App\Http\Controllers\Admin\SectorController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Models\Testimonial;
use Flasher\Laravel\Facade\Flasher;
use Flasher\Prime\FlasherInterface;

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


        // Route::resource('project', ProjectController::class);

        // Banner Routes
        Route::resource('banner',BannerController::class);

        // Announcement Routes
        Route::resource('announcement',AnnouncementController::class);

        // Course Resource Routes
        Route::resource('course',CourseController::class);

        // Blog Routes
        Route::resource('blog',BlogController::class);

        // Brand Routes
        Route::resource('brand', BrandController::class);

        // Testimonial Routes
        Route::resource('testimonial', TestimonialController::class);

        // Activities Routes
        Route::resource('activity', ActivityController::class);

        // Enquiry Routes
        Route::resource('enquiry',EnquiryController::class);

        // Student Routes
        Route::resource('student',StudentController::class);

        // organization Routes
        Route::resource('organization',OrganizationController::class);

        // organization Routes
        Route::resource('volunteer',VolunteerController::class);

        // Country Routes
        Route::resource('country',CountryController::class);

        // Country Routes
        Route::resource('intlcourse',IntlCourseController::class);

        // Onrginzation Routes
        // Route::resource('organization',Or::class);

        // Survey Routes
        Route::resource('feedback', App\Http\Controllers\Admin\FeedbackController::class);

        // Setting Home Page Settings Route
        Route::get('settings/home/edit',[SettingController::class,'editHomePage'])->name('setting.home.edit');
        Route::post('settings/home/update/{id}', [SettingController::class, 'homeUpdate'])->name('setting.home.update');

        // Setting Genral Settings
        Route::get('/settings/general/edit',[SettingController::class,'generalEdit'])->name('setting.general.edit');
        Route::post('/settings/general/update',[SettingController::class,'generalUpdate'])->name('setting.general.update');

        Route::post('project/bulk-action', [ProjectController::class, 'bulkAction'])->name('project.bulk-action');
        Route::get('project/stats', [ProjectController::class, 'getStats'])->name('project.stats');
        // Display milestone creation page
        Route::get('/projects/{project}/milestones/create', [ProjectController::class, 'createMilestone'])->name('project.milestones.create');

        // Save milestones
        Route::post('/projects/milestones/store', [ProjectController::class, 'storeMilestones'])->name('project.milestones.store');
        // Get milestones (JSON)
        Route::get('/projects/{project}/milestones/list', [ProjectController::class, 'getMilestones'])->name('project.milestones.list');
        // Estimator
        Route::controller(App\Http\Controllers\Admin\ProjectEstimatorController::class)->group(function () {
             Route::get('project/estmator/{project_id}', 'index')->name('project.estmator.index');
             Route::post('project/estimator/item', 'storeEstimationItem')->name('project.estmator.item.store');
             Route::delete('project/estimator/item/{id}', 'deleteEstimationItem')->name('project.estmator.item.delete');
             Route::post('project/estimator/donor', 'storeDonor')->name('project.estmator.donor.store');
             Route::delete('project/estimator/donor/{id}', 'deleteDonor')->name('project.estmator.donor.delete');
             Route::post('project/estimator/funding', 'storeFunding')->name('project.estmator.funding.store');
             Route::delete('project/estimator/funding/{id}', 'deleteFunding')->name('project.estmator.funding.delete');
             Route::post('project/estimator/import', 'importFromEstimation')->name('project.estmator.import');
             Route::post('project/estimator/utilization', 'storeUtilization')->name('project.estmator.utilization.store');
             Route::delete('project/estimator/utilization/{id}', 'deleteUtilization')->name('project.estmator.utilization.delete');
        });
        // field Log
        Route::get('/projet/fieldlog', [ProjectController::class,'createMilestone']);

        Route::get('/survey/{project_id}/list', [SurveyController::class, 'index'])->name('survey.index');
        Route::get('/survey/{project_id}/survey/create', [SurveyController::class, 'create'])->name('survey.create');
        Route::post('/survey/{project_id}/survey/store', [SurveyController::class, 'store'])->name('survey.store');
        Route::get('/survey/{project_id}/survey/{id}/edit', [SurveyController::class, 'edit'])->name('survey.edit');
        Route::post('/survey/{project_id}/survey/{id}/update', [SurveyController::class, 'update'])->name('survey.update');
        Route::delete('/survey/{project_id}/survey/{id}/delete', [SurveyController::class, 'destroy'])->name('survey.destroy');

        Route::resource('project', ProjectController::class);
        Route::get('project/{project}/toggle-status', [ProjectController::class, 'toggleStatus'])->name('project.toggle-status');
        Route::get('project/export', [ProjectController::class, 'export'])->name('project.export');

        Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');
        Route::get('/empty', function () {
            notyf()->addSuccess('Your account has been verified.');
            return view('admin.empty.empty');
        });
    });
});
