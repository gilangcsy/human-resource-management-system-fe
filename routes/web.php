<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClaimTypeController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\ApprovalTemplateController;
use App\Http\Controllers\LeaveController;

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
	
	//-----------------------------------------------LEAVE APPLICATION-----------------------------------------------//
	Route::prefix('leave/')->namespace('Leave')->group(function () {
		Route::get('', [LeaveController::class, 'index'])->name('leave.index');
		Route::get('/create', [LeaveController::class, 'create'])->name('leave.create');
		Route::post('/', [LeaveController::class, 'store'])->name('leave.store');
		Route::get('/edit/{id}', [LeaveController::class, 'edit'])->name('leave.edit');
		Route::get('/show/{id}', [LeaveController::class, 'show'])->name('leave.show');
		Route::patch('/edit/{id}', [LeaveController::class, 'update'])->name('leave.update');
		Route::delete('/destroy/{id}', [LeaveController::class, 'destroy'])->name('leave.destroy');
	});



	//-----------------------------------------------MASTER DATA-----------------------------------------------//

	//-----------------------------------------------CLAIM TYPE-----------------------------------------------//
	Route::prefix('claim-type/')->namespace('Claim Type')->group(function () {
		Route::get('', [ClaimTypeController::class, 'index'])->name('claim-type.index');
		Route::get('/create', [ClaimTypeController::class, 'create'])->name('claim-type.create');
		Route::post('/', [ClaimTypeController::class, 'store'])->name('claim-type.store');
		Route::get('/edit/{id}', [ClaimTypeController::class, 'edit'])->name('claim-type.edit');
		Route::patch('/edit/{id}', [ClaimTypeController::class, 'update'])->name('claim-type.update');
		Route::delete('/destroy/{id}', [ClaimTypeController::class, 'destroy'])->name('claim-type.destroy');
	});

	//-----------------------------------------------LEAVE TYPE-----------------------------------------------//
	Route::prefix('leave-type/')->namespace('Leave Type')->group(function () {
		Route::get('', [LeaveTypeController::class, 'index'])->name('leave-type.index');
		Route::get('/create', [LeaveTypeController::class, 'create'])->name('leave-type.create');
		Route::post('/', [LeaveTypeController::class, 'store'])->name('leave-type.store');
		Route::get('/edit/{id}', [LeaveTypeController::class, 'edit'])->name('leave-type.edit');
		Route::get('/show/{id}', [LeaveTypeController::class, 'show'])->name('leave-type.show');
		Route::patch('/edit/{id}', [LeaveTypeController::class, 'update'])->name('leave-type.update');
		Route::delete('/destroy/{id}', [LeaveTypeController::class, 'destroy'])->name('leave-type.destroy');
	});

	//-----------------------------------------------APPROVAL TEMPLATE-----------------------------------------------//
	Route::prefix('approval-template/')->namespace('Approval Template')->group(function () {
		Route::get('', [ApprovalTemplateController::class, 'index'])->name('approval-template.index');
		Route::get('/create', [ApprovalTemplateController::class, 'create'])->name('approval-template.create');
		Route::post('/', [ApprovalTemplateController::class, 'store'])->name('approval-template.store');
		Route::get('/edit/{id}', [ApprovalTemplateController::class, 'edit'])->name('approval-template.edit');
		Route::patch('/edit/{id}', [ApprovalTemplateController::class, 'update'])->name('approval-template.update');
		Route::delete('/destroy/{id}', [ApprovalTemplateController::class, 'destroy'])->name('approval-template.destroy');
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
