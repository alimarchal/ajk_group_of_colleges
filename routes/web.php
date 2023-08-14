<?php

use App\Http\Controllers\GuardianController;
use App\Http\Controllers\InstituteMigrationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentGurdianAlertContactController;
use App\Http\Controllers\StudentInformationController;
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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    //
    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
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

    Route::get('student/{student}/print', [StudentController::class, 'print'])->name('student.print');


});
