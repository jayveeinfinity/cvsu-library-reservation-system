<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\WifiLogsController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\InHouseLogsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\LearningSpaceController;
use App\Http\Controllers\InHouseClassificationsController;

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
Route::get('/about-us', function() {
    echo 'About us page';
})->name('landing.aboutus');

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
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');

        Route::post('/reservations/{id}/approve', [ReservationController::class, 'approve'])->name('admin.reservations.approve');
        Route::post('/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('admin.reservations.reject');
    });
});