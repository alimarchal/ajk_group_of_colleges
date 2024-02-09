<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ChallanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeeTypeController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\InstituteClassController;
use App\Http\Controllers\InstituteMigrationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentGurdianAlertContactController;
use App\Http\Controllers\StudentInformationController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return to_route('login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');


    // New Student Admision
    Route::get('/student-information', [StudentInformationController::class, 'index'])->name('student-information.index');
    Route::resource('student', StudentController::class);

    // Student Guardian Information
    Route::get('student/{student}/guardian', [GuardianController::class, 'show'])->name('student.guardians');
    Route::post('guardian/{student}', [GuardianController::class, 'store'])->name('guardian.store');
    Route::put('guardian/{student}', [GuardianController::class, 'update'])->name('guardian.update');

    // Student Emergencty Contact
    Route::get('student/{student}/alert', [StudentGurdianAlertContactController::class, 'show'])->name('student.guardians.alerts');
    Route::post('alerts/{student}', [StudentGurdianAlertContactController::class, 'store'])->name('student.guardians.alerts.store');
    Route::put('alerts/{student}', [StudentGurdianAlertContactController::class, 'update'])->name('student.guardians.alerts.update');

    // Student Migration If Any
    Route::get('student/{student}/migration', [InstituteMigrationController::class, 'show'])->name('student.instituteMigrationStudent.alerts');
    Route::post('instituteMigrationStudent/{student}', [InstituteMigrationController::class, 'store'])->name('student.instituteMigrationStudent.store');
    Route::put('instituteMigrationStudent/{instituteMigratedStudent}', [InstituteMigrationController::class, 'update'])->name('student.instituteMigrationStudent.update');

    Route::get('student/{student}/generate-challan', [ChallanController::class, 'generate'])->name('student.generate-challan');
    Route::post('student/{student}/generate-challan', [ChallanController::class, 'generate'])->name('student.generate-challan.post');
    Route::delete('student/{student}/generate-challan/{feeTypeCart}', [ChallanController::class, 'generatedChallanDelete'])->name('student.generate-challan.generatedChallanDelete');
    Route::post('student/{student}/generateFinalChallan', [ChallanController::class, 'generateFinalChallan'])->name('student.generate-challan.generateFinalChallan');
    Route::get('student/{student}/fee-challans', [ChallanController::class, 'feeChallans'])->name('student.fee-challans');


    Route::get('student/{student}/print', [StudentController::class, 'print'])->name('student.print');

    Route::get('/fee-information', [FeeTypeController::class, 'feeInformationIndex'])->name('fee-information.feeInformationIndex');
    Route::resource('feeType', FeeTypeController::class);
    Route::get('payment/{challan}', [PaymentController::class, 'show']);
    Route::get('payment/{challan}/edit', [PaymentController::class, 'edit']);
    Route::put('payment/{challan}', [PaymentController::class, 'update']);
    Route::resource('payment', PaymentController::class);


    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::resource('instituteClass', InstituteClassController::class);

    Route::get('staff-information', [StaffController::class, 'index'])->name('staff-information');
    Route::get('staff-information/teachers', [StaffController::class, 'teachers'])->name('staff-information.teachers');
    Route::get('/staff-information/teachers/{user}/edit', [StaffController::class, 'edit'])->name('staff-information.teachers.edit');
    Route::put('/staff-information/teachers/{user}', [StaffController::class, 'update'])->name('staff-information.teachers.update');
//    Route::get('/staff-information/teachers/create', [UserController::class, 'create'])->name('users.create');
//    Route::post('/users', [UserController::class, 'store'])->name('users.store');
//


    Route::get('student-attendance', [AttendanceController::class, 'index'])->name('student-attendance.index');

    Route::resource('section', SectionController::class);
    Route::resource('subject', SubjectController::class);


});
