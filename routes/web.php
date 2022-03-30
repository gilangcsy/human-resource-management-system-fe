<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;

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



Route::group(['middleware' => ['auth.check']], function () {
	Route::prefix('admin/')
		->namespace('Admin')
		->group(function () {
			Route::get('', [AdminController::class, 'index'])->name('admin.dashboard');
	});
	
	Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');

	Route::prefix('user-management/')->namespace('User Management')->group(function () {
		Route::get('', [UserManagementController::class, 'index'])->name('user-management.index');
		Route::get('/{id}', [UserManagementController::class, 'edit'])->name('user-management.edit');
		Route::patch('/{id}', [UserManagementController::class, 'update'])->name('user-management.update');
		Route::post('', [UserManagementController::class, 'send_invitational'])->name('user-management.send_invitational');
		Route::delete('/{id}/{deletedBy}', [UserManagementController::class, 'destroy'])->name('user-management.destroy');
		Route::get('/setActive/{id}', [UserManagementController::class, 'set_active'])->name('user-management.set_active');
	});

	Route::prefix('my-attendance/')->namespace('Self Service')->group(function () {
		Route::get('', [AttendanceController::class, 'index'])->name('attendance.index');
		Route::get('/create', [AttendanceController::class, 'create'])->name('attendance.create');
		Route::post('/', [AttendanceController::class, 'store'])->name('attendance.store');
		Route::get('/edit/{id}', [AttendanceController::class, 'edit'])->name('attendance.edit');
		Route::patch('/edit/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
	});
});



Route::prefix('auth/')->namespace('Auth')->group(function () {
	Route::get('', [AuthController::class, 'index'])->name('auth.index');
	Route::get('invitational', [AuthController::class, 'create'])->name('auth.invitational');
	Route::post('', [AuthController::class, 'store'])->name('auth.store');
	Route::patch('', [AuthController::class, 'accept'])->name('auth.accept');
	Route::post('/logout', [AuthController::class, 'destroy'])->name('auth.logout');

	Route::get('invitational/{token}', [AuthController::class, 'check_token'])->name('invitational.index');
});
