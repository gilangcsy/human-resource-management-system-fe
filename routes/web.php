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
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ApprovalAuthorization;
use App\Http\Controllers\ApprovalLeaveController;
use App\Http\Controllers\AccessRightsController;
use App\Http\Controllers\MenuController;

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



Route::group(['middleware' => ['auth.check', 'access.rights']], function () {
	Route::prefix('admin/')
		->namespace('Admin')
		->group(function () {
			Route::get('', [AdminController::class, 'index'])->name('admin.dashboard');
	});
	Route::get('', function () {
		return redirect()->route('dashboard.index');
	});
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

	//=============MONITORING=====================================================================================================//
	
	//-------------APPROVAL LEAVE ------------------------------------------------------------------------------------------------//
	Route::prefix('approval-leave/')->namespace('Leave')->group(function () {
		Route::get('', [ApprovalLeaveController::class, 'index'])->name('approval-leave.index');
		Route::get('/create', [ApprovalLeaveController::class, 'create'])->name('approval-leave.create');
		Route::post('/', [ApprovalLeaveController::class, 'store'])->name('approval-leave.store');
		Route::get('/edit/{id}', [ApprovalLeaveController::class, 'edit'])->name('approval-leave.edit');
		Route::get('/show/{id}', [ApprovalLeaveController::class, 'show'])->name('approval-leave.show');
		Route::patch('/edit/{id}', [ApprovalLeaveController::class, 'update'])->name('approval-leave.update');
		Route::delete('/destroy/{id}', [ApprovalLeaveController::class, 'destroy'])->name('approval-leave.destroy');
		Route::post('/create', [ApprovalLeaveController::class, 'action'])->name('approval-leave.action');
	});
	//=============END OF SELF SERVICE============================================================================================//



	
	//=============SELF SERVICE===================================================================================================//

	//-------------MY ATTENDANCE--------------------------------------------------------------------------------------------------//
	Route::prefix('attendance/')->namespace('Self Service')->group(function () {
		Route::get('', [AttendanceController::class, 'index'])->name('attendance.index');
		Route::get('/create', [AttendanceController::class, 'create'])->name('attendance.create');
		Route::post('/', [AttendanceController::class, 'store'])->name('attendance.store');
		Route::get('/edit/{id}', [AttendanceController::class, 'edit'])->name('attendance.edit');
		Route::patch('/edit/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
	});
	
	//-------------LEAVE APPLICATION----------------------------------------------------------------------------------------------//
	Route::prefix('leave/')->namespace('Leave')->group(function () {
		Route::get('', [LeaveController::class, 'index'])->name('leave.index');
		Route::get('/create', [LeaveController::class, 'create'])->name('leave.create');
		Route::post('/', [LeaveController::class, 'store'])->name('leave.store');
		Route::get('/edit/{id}', [LeaveController::class, 'edit'])->name('leave.edit');
		Route::get('/show/{id}', [LeaveController::class, 'show'])->name('leave.show');
		Route::patch('/edit/{id}', [LeaveController::class, 'update'])->name('leave.update');
		Route::delete('/destroy/{id}', [LeaveController::class, 'destroy'])->name('leave.destroy');
	});
	//=============END OF SELF SERVICE============================================================================================//





	//=============MASTER DATA=====================================================================================================//
	//-------------APPROVAL TEMPLATE-----------------------------------------------------------------------------------------------//
	Route::prefix('approval-template/')->namespace('Approval Template')->group(function () {
		Route::get('', [ApprovalTemplateController::class, 'index'])->name('approval-template.index');
		Route::get('/create', [ApprovalTemplateController::class, 'create'])->name('approval-template.create');
		Route::post('/', [ApprovalTemplateController::class, 'store'])->name('approval-template.store');
		Route::get('/edit/{id}', [ApprovalTemplateController::class, 'edit'])->name('approval-template.edit');
		Route::patch('/edit/{id}', [ApprovalTemplateController::class, 'update'])->name('approval-template.update');
		Route::delete('/destroy/{id}', [ApprovalTemplateController::class, 'destroy'])->name('approval-template.destroy');
	});

	//-------------CLAIM TYPE------------------------------------------------------------------------------------------------------//
	Route::prefix('claim-type/')->namespace('Claim Type')->group(function () {
		Route::get('', [ClaimTypeController::class, 'index'])->name('claim-type.index');
		Route::get('/create', [ClaimTypeController::class, 'create'])->name('claim-type.create');
		Route::post('/', [ClaimTypeController::class, 'store'])->name('claim-type.store');
		Route::get('/edit/{id}', [ClaimTypeController::class, 'edit'])->name('claim-type.edit');
		Route::patch('/edit/{id}', [ClaimTypeController::class, 'update'])->name('claim-type.update');
		Route::delete('/destroy/{id}', [ClaimTypeController::class, 'destroy'])->name('claim-type.destroy');
	});

	//-------------LEAVE TYPE------------------------------------------------------------------------------------------------------//
	Route::prefix('leave-type/')->namespace('Leave Type')->group(function () {
		Route::get('', [LeaveTypeController::class, 'index'])->name('leave-type.index');
		Route::get('/create', [LeaveTypeController::class, 'create'])->name('leave-type.create');
		Route::post('/', [LeaveTypeController::class, 'store'])->name('leave-type.store');
		Route::get('/edit/{id}', [LeaveTypeController::class, 'edit'])->name('leave-type.edit');
		Route::get('/show/{id}', [LeaveTypeController::class, 'show'])->name('leave-type.show');
		Route::patch('/edit/{id}', [LeaveTypeController::class, 'update'])->name('leave-type.update');
		Route::delete('/destroy/{id}', [LeaveTypeController::class, 'destroy'])->name('leave-type.destroy');
	});

	//-------------MENU-----------------------------------------------------------------------------------------------------------//
	Route::prefix('menu/')->namespace('Menu')->group(function () {
		Route::get('', [MenuController::class, 'index'])->name('menu.index');
		Route::get('/create', [MenuController::class, 'create'])->name('menu.create');
		Route::post('/', [MenuController::class, 'store'])->name('menu.store');
		Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
		Route::patch('/edit/{id}', [MenuController::class, 'update'])->name('menu.update');
		Route::delete('/destroy/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
	});

	//-------------ROLE-----------------------------------------------------------------------------------------------------------//
	Route::prefix('role/')->namespace('Role')->group(function () {
		Route::get('', [RoleController::class, 'index'])->name('role.index');
		Route::get('/create', [RoleController::class, 'create'])->name('role.create');
		Route::post('/', [RoleController::class, 'store'])->name('role.store');
		Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
		Route::patch('/edit/{id}', [RoleController::class, 'update'])->name('role.update');
		Route::delete('/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
	});

	//=============END OF MASTER DATA=============================================================================================//





	//=============USER MANAGEMENT================================================================================================//
	//-------------ACCESS RIGHTS--------------------------------------------------------------------------------------------------//
	Route::prefix('access-rights/')->namespace('Approval Authorization')->group(function () {
		Route::get('', [AccessRightsController::class, 'index'])->name('access-rights.index');
		Route::get('/create', [AccessRightsController::class, 'create'])->name('access-rights.create');
		//!!
		Route::get('/edit/{id}', [AccessRightsController::class, 'edit'])->name('access-rights.edit');
		Route::patch('/{id}', [AccessRightsController::class, 'update'])->name('access-rights.update');
		Route::post('', [AccessRightsController::class, 'store'])->name('access-rights.store');
		Route::delete('/destroy/{id}', [AccessRightsController::class, 'destroy'])->name('access-rights.destroy');
	});

	//-------------APPROVAL AUTHORIZATION-----------------------------------------------------------------------------------------//
	Route::prefix('approval-authorization/')->namespace('Approval Authorization')->group(function () {
		Route::get('', [ApprovalAuthorization::class, 'index'])->name('approval-authorization.index');
		Route::get('/create', [ApprovalAuthorization::class, 'create'])->name('approval-authorization.create');
		Route::get('/{id}', [ApprovalAuthorization::class, 'edit'])->name('approval-authorization.edit');
		Route::patch('/{id}', [ApprovalAuthorization::class, 'update'])->name('approval-authorization.update');
		Route::post('', [ApprovalAuthorization::class, 'store'])->name('approval-authorization.store');
		Route::delete('/destroy/{id}', [ApprovalAuthorization::class, 'destroy'])->name('approval-authorization.destroy');
	});

	//-------------EMPLOYEE-------------------------------------------------------------------------------------------------------//
	Route::prefix('employee/')->namespace('User Management')->group(function () {
		Route::get('', [UserManagementController::class, 'index'])->name('employee.index');
		Route::get('/create', [UserManagementController::class, 'create'])->name('employee.create');
		Route::get('/edit/{id}', [UserManagementController::class, 'edit'])->name('employee.edit');
		Route::patch('/{id}', [UserManagementController::class, 'update'])->name('employee.update');
		Route::post('', [UserManagementController::class, 'send_invitational'])->name('employee.send_invitational');
		Route::delete('/destroy/{id}/{deletedBy}', [UserManagementController::class, 'destroy'])->name('employee.destroy');
		Route::get('/setActive/{id}', [UserManagementController::class, 'set_active'])->name('employee.set_active');
	});
	//=============END OF USER MANAGEMENT=========================================================================================//

});


Route::prefix('auth/')->namespace('Auth')->group(function () {
	Route::get('', [AuthController::class, 'index'])->name('auth.index');
	Route::get('invitational', [AuthController::class, 'create'])->name('auth.invitational');
	Route::post('', [AuthController::class, 'store'])->name('auth.store');
	Route::patch('', [AuthController::class, 'accept'])->name('auth.accept');
	Route::post('/logout', [AuthController::class, 'destroy'])->name('auth.logout');

	Route::get('invitational/{token}', [AuthController::class, 'check_token'])->name('invitational.index');
});
