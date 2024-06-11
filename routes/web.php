<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\LearningSpaceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
Route::post('/schedules/available-slots', [ScheduleController::class, 'getAvailableSlots'])->name('schedules.getAvailableSlots');
Route::get('/facilities', [FacilityController::class, 'index'])->name('landing.facilities');
Route::get('/facilities/{slug}', [FacilityController::class, 'show'])->name('landing.facility');
Route::get('/rules', [LandingController::class, 'rules'])->name('landing.rules');
Route::get('/about-us', [LandingController::class, 'aboutus'])->name('landing.aboutus');

Route::get('/auth', [AuthController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('/auth/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/logout', [AuthController::class, 'logout'])->name('google.logout');

Route::get('/signup', [RegistrationController::class, 'create']);

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');

    Route::prefix('admin')->group(function () {
        Route::get('/', function() {
            return redirect()->route('admin.dashboard');
        });
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/reservations', [ReservationController::class, 'index'])->name('admin.reservations.index');

        Route::get('/learning-spaces', [LearningSpaceController::class, 'index'])->name('admin.learningspaces.index');
        Route::get('/learning-spaces/create', [LearningSpaceController::class, 'create'])->name('admin.learningspaces.create');
        Route::get('/learning-spaces/{id}', [LearningSpaceController::class, 'show'])->name('admin.learningspaces.show');
        Route::post('/learning-spaces/store', [LearningSpaceController::class, 'store'])->name('admin.learningspaces.store');
        Route::post('/learning-spaces/set-cover', [LearningSpaceController::class, 'setAsCover'])->name('admin.learningspaces.setCover');

        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');

        Route::post('/reservations/{id}/approve', [ReservationController::class, 'approve'])->name('admin.reservations.approve');
        Route::post('/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('admin.reservations.reject');

        Route::get('/amenities', [AmenityController::class, 'index'])->name('admin.amenities.index');
        Route::get('/amenities/create', [AmenityController::class, 'create'])->name('admin.amenities.create');
        Route::post('/amenities/store', [AmenityController::class, 'store'])->name('admin.amenities.store');
        Route::post('/amenities/destroy', [AmenityController::class, 'destroy'])->name('admin.amenities.destroy');

        Route::post('/images/cover/upload', [ImageController::class, 'UploadCover'])->name('admin.images.coverUpload');
        Route::post('/images/upload', [ImageController::class, 'UploadImageToGallery'])->name('admin.images.upload');
        Route::post('/images/destroy', [ImageController::class, 'destroy'])->name('admin.images.destroy');
    });
});