<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\DashboardController;
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
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authLogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/forgot-password', [AuthController::class, 'postForgotPassword']);
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword']);
Route::post('/reset-password/{token}', [AuthController::class, 'postResetPassword']);




Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/admin/admin/list', [AdminController::class, 'list']);
    Route::get('/admin/admin/add-admin', [AdminController::class, 'addAdmin']);
    Route::post('/admin/admin/add-admin', [AdminController::class, 'insertAdmin']);
    Route::get('/admin/admin/edit/{id}', [AdminController::class, 'editAdmin']);
    Route::post('/admin/admin/edit/{id}', [AdminController::class, 'updateAdmin']);
    Route::get('/admin/admin/delete/{id}', [AdminController::class, 'deleteAdmin']);


    //class URL
    Route::get('/admin/class/list', [ClassController::class, 'classList']);
    Route::get('/admin/class/add-class', [ClassController::class, 'addClass']);
    Route::post('/admin/class/add-class', [ClassController::class, 'insertClass']);
    Route::get('/admin/class/edit/{id}', [ClassController::class, 'editClass']);
    Route::post('/admin/class/edit/{id}', [ClassController::class, 'updateClass']);
    Route::get('/admin/class/delete/{id}', [ClassController::class, 'deleteClass']);

    //Subject URL
    Route::get('/admin/subject/list', [SubjectController::class, 'subjectList']);
    Route::get('/admin/subject/add-subject', [SubjectController::class, 'addSubject']);
    Route::post('/admin/subject/add-subject', [SubjectController::class, 'insertSubject']);
    Route::get('/admin/subject/edit/{id}', [SubjectController::class, 'editSubject']);
    Route::post('/admin/subject/edit/{id}', [SubjectController::class, 'updateSubject']);
    Route::get('/admin/subject/delete/{id}', [SubjectController::class, 'deleteSubject']);

    //Class Subject URL
    Route::get('/admin/class-subject/list', [ClassSubjectController::class, 'classSubjectList']);
    Route::get('/admin/class-subject/add', [ClassSubjectController::class, 'addClassSubject']);
    Route::post('/admin/class-subject/add', [ClassSubjectController::class, 'insertClassSubject']);
    Route::get('/admin/class-subject/edit/{id}', [ClassSubjectController::class, 'editClassSubject']);
    Route::post('/admin/class-subject/edit/{id}', [ClassSubjectController::class, 'updateClassSubject']);
    Route::get('/admin/class-subject/delete/{id}', [ClassSubjectController::class, 'deleteClassSubject']);
    Route::get('/admin/class-subject/edit-single/{id}', [ClassSubjectController::class, 'editSingleClassSubject']);
    Route::post('/admin/class-subject/edit-single/{id}', [ClassSubjectController::class, 'updateSingleClassSubject']);

    //change password
    Route::get('/admin/change-password', [UserController::class, 'changePassword']);
    Route::post('/admin/change-password', [UserController::class, 'updateChangePassword']);
});

Route::group(['middleware' => 'teacher'], function () {
    Route::get('/teacher/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('/teacher/change-password', [UserController::class, 'changePassword']);
    Route::post('/teacher/change-password', [UserController::class, 'updateChangePassword']);
});

Route::group(['middleware' => 'student'], function () {
    Route::get('/student/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('/student/change-password', [UserController::class, 'changePassword']);
    Route::post('/student/change-password', [UserController::class, 'updateChangePassword']);
});

Route::group(['middleware' => 'parent'], function () {
    Route::get('/parent/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('/parent/change-password', [UserController::class, 'changePassword']);
    Route::post('/parent/change-password', [UserController::class, 'updateChangePassword']);
});
