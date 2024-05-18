<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\WifiLogsController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\InHouseLogsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReservationController;
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
Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
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

    Route::prefix('admin')->group(function () {
        Route::get('/', function() {
            return redirect()->route('admin.dashboard');
        });
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/reservations', [ReservationController::class, 'index'])->name('admin.reservations.index');
    /*
    |--------------------------------------------------------------------------
    | Violation Management System
    |--------------------------------------------------------------------------
    */
        Route::get('/violations/create', function () {
            return view('violationForm');
        })->name('admin.violationList');

        Route::get('/violations', [ViolationController::class, 'showForm'])->name('admin.result');
        Route::post('/store', [ViolationController::class, 'store'])->name('admin.store');
        Route::get('/update/{id}', [ViolationController::class, 'update'])->name('update');
        Route::get('/search',[ViolationController::class, 'search'])->name('admin.search');
        Route::get('/filter', [ViolationController::class, 'filter'])->name('filter');
        Route::post('/patron/search', [ViolationController::class, 'findPatron']);
        Route::post('/select', [ViolationController::class, 'select'])->name('admin.select');
    /*
    |--------------------------------------------------------------------------
    | WiFi Logging Management System
    |--------------------------------------------------------------------------
    */
        Route::get('/wifi', function () {
            return view('wifi');
        })->name('admin.wifi');
        Route::get('/chart', [WifiLogsController::class, 'chart'])->name('chart');
        Route::get('/recent', [WifiLogsController::class, 'recent'])->name('recent');
        Route::post('/admin.wifi', [WifiLogsController::class, 'store'])->name('store');
    /*
    |--------------------------------------------------------------------------
    | In House Management System
    |--------------------------------------------------------------------------
    */
        Route::get('/inhouse', [InHouseLogsController::class, 'index'])->name('admin.inhouse');
        Route::get('/inhouse/chart', [InHouseLogsController::class, 'chartInfo']);
        Route::get('/inhouse/classification', [InHouseClassificationsController::class, 'class'])->name('admin.inhouse.class');
        Route::get('/inhouse/editclassification', [InHouseClassificationsController::class, 'editView'])->name('admin.editclass');
        Route::get('/inhouse/editclassification/{id}', [InHouseClassificationsController::class, 'edit']);
        Route::get('/inhouse/classification/{id}', [InHouseClassificationsController::class, 'show']);
        Route::post('/inhouse/addclassification', [InHouseClassificationsController::class, 'store'])->name('admin.InHouseAddClass');
        Route::post('/inhouse/addlogs', [InHouseLogsController::class, 'store'])->name('admin.InHouseAddLogs');
        Route::patch('/inhouse/editclassification/{id}/edit', [InHouseClassificationsController::class, 'update']);
    });
});