<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\CommunicateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\TeacherController;
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

    //Teacher
    Route::get('/admin/teacher/list', [TeacherController::class, 'listTeacher']);
    // Route::get('/admin/student/view-student/{id}', [TeacherController::class, 'viewTeacher']);
    Route::get('/admin/teacher/add-teacher', [TeacherController::class, 'addTeacher']);
    Route::post('/admin/teacher/add-teacher', [TeacherController::class, 'insertTeacher']);
    Route::get('/admin/teacher/edit-teacher/{id}', [TeacherController::class, 'editTeacher']);
    Route::post('/admin/teacher/edit-teacher/{id}', [TeacherController::class, 'updateTeacher']);
    Route::get('/admin/teacher/delete/{id}', [TeachertController::class, 'deleteTeacher']);
    Route::get('/admin/teacher/view-teacher/{id}', [TeacherController::class, 'viewTeacher']);

    //Student
    Route::get('/admin/student/list', [StudentController::class, 'listStudent']);
    Route::get('/admin/student/view-student/{id}', [StudentController::class, 'viewStudent']);
    Route::get('/admin/student/add-student', [StudentController::class, 'addStudent']);
    Route::post('/admin/student/add-student', [StudentController::class, 'insertStudent']);
    Route::get('/admin/student/edit-student/{id}', [StudentController::class, 'editStudent']);
    Route::post('/admin/student/edit-student/{id}', [StudentController::class, 'updateStudent']);
    Route::get('/admin/student/delete/{id}', [StudentController::class, 'deleteStudent']);

    //Parent
    Route::get('/admin/parent/list', [ParentController::class, 'listParent']);
    Route::get('/admin/parent/add-parent', [ParentController::class, 'addParent']);
    Route::post('/admin/parent/add-parent', [ParentController::class, 'insertParent']);
    Route::get('/admin/parent/edit-parent/{id}', [ParentController::class, 'editParent']);
    Route::post('/admin/parent/edit-parent/{id}', [ParentController::class, 'updateParent']);
    Route::get('/admin/parent/delete-parent/{id}', [ParentController::class, 'deleteParent']);
    Route::get('/admin/parent/my-student/{id}', [ParentController::class, 'myStudent']);
    Route::get('/admin/parent/assign-student-parent/{student_id}/{parent_id}', [ParentController::class, 'assignStudentParent']);
    Route::get('/admin/parent/assign-student-parent-delete/{student_id}', [ParentController::class, 'assignStudentParentDelete']);



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

    //Assign Class to Subject URL
    Route::get('/admin/class-subject/list', [ClassSubjectController::class, 'classSubjectList']);
    Route::get('/admin/class-subject/add', [ClassSubjectController::class, 'addClassSubject']);
    Route::post('/admin/class-subject/add', [ClassSubjectController::class, 'insertClassSubject']);
    Route::get('/admin/class-subject/edit/{id}', [ClassSubjectController::class, 'editClassSubject']);
    Route::post('/admin/class-subject/edit/{id}', [ClassSubjectController::class, 'updateClassSubject']);
    Route::get('/admin/class-subject/delete/{id}', [ClassSubjectController::class, 'deleteClassSubject']);
    Route::get('/admin/class-subject/edit-single/{id}', [ClassSubjectController::class, 'editSingleClassSubject']);
    Route::post('/admin/class-subject/edit-single/{id}', [ClassSubjectController::class, 'updateSingleClassSubject']);


    //Assign class to teacher
    Route::get('/admin/assign-class-teacher/list', [AssignClassTeacherController::class, 'assignClassTeacherList']);
    Route::get('/admin/assign-class-teacher/add', [AssignClassTeacherController::class, 'assignClassTeacher']);
    Route::post('/admin/assign-class-teacher/add', [AssignClassTeacherController::class, 'insertAssignClassTeacher']);
    Route::get('/admin/assign-class-teacher/edit/{id}', [AssignClassTeacherController::class, 'editAssignClassTeacher']);
    Route::post('/admin/assign-class-teacher/edit/{id}', [AssignClassTeacherController::class, 'updateAssignClassTeacher']);
    Route::get('/admin/assign-class-teacher/edit-single/{id}', [AssignClassTeacherController::class, 'editSingleAssignClassTeacher']);
    Route::post('/admin/assign-class-teacher/edit-single/{id}', [AssignClassTeacherController::class, 'updateSingleAssignClassTeacher']);
    Route::get('/admin/assign-class-teacher/delete/{id}', [AssignClassTeacherController::class, 'deleteAssignClassTeacher']);

    //change password
    Route::get('/admin/change-password', [UserController::class, 'changePassword']);
    Route::post('/admin/change-password', [UserController::class, 'updateChangePassword']);

    //CLASS Timetable
    Route::get('/admin/class-timetable/list', [ClassTimetableController::class, 'classTimetableList']);
    Route::post('/admin/class-timetable/add', [ClassTimetableController::class, 'insert_update']);

    Route::post('/admin/class_timetable/get_subject ', [ClassTimetableController::class, 'getSubject']);



    //Notice board
    Route::get('/admin/communicate/notice-board', [CommunicateController::class, 'noticeBoard']);
    Route::get('/admin/communicate/notice-board/add', [CommunicateController::class, 'addNoticeBoard']);
    Route::post('/admin/communicate/notice-board/add', [CommunicateController::class, 'insertNoticeBoard']);
    Route::get('/admin/communicate/notice-board/edit/{id}', [CommunicateController::class, 'editNoticeBoard']);
    Route::post('/admin/communicate/notice-board/edit/{id}', [CommunicateController::class, 'updateNoticeBoard']);
    Route::get('/admin/communicate/notice-board/delete/{id}', [CommunicateController::class, 'deleteNoticeBoard']);


    //EMAIL
    Route::get('/admin/communicate/send-email', [CommunicateController::class, 'sendEmail']);
    Route::post('/admin/communicate/send-email', [CommunicateController::class, 'sendEmailUser']);
    Route::get('/admin/communicate/search_user', [CommunicateController::class, 'searchUser']);

    //HOMEWORK
    Route::get('/admin/homework/homework', [HomeworkController::class, 'homework']);
    Route::get('/admin/homework/create-homework', [HomeworkController::class, 'createHomework']);
    Route::post('/admin/homework/create-homework', [HomeworkController::class, 'insertHomework']);
    Route::post('admin/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject']);
    // Route::get('/admin/homework/view-homework/{id}', [HomeworkController::class, 'viewHomework']);
    Route::get('/admin/homework/edit-homework/{id}', [HomeworkController::class, 'editHomework']);
    Route::post('/admin/homework/edit-homework/{id}', [HomeworkController::class, 'updateHomework']);
    Route::get('/admin/homework/delete-homework/{id}', [HomeworkController::class, 'deleteHomework']);
    Route::get('/admin/homework/submitted-homework/{id}', [HomeworkController::class, 'adminSubmittedHomework']);
    Route::get('/admin/homework/homework-report', [HomeworkController::class, 'homeworkReport']);

    //Examination
    Route::get('/admin/examination/exam-list', [ExaminationController::class, 'examList']);
    Route::get('/admin/examination/add-exam', [ExaminationController::class, 'addExam']);
    Route::post('/admin/examination/add-exam', [ExaminationController::class, 'insertExam']);
    Route::get('/admin/examination/edit-exam/{id}', [ExaminationController::class, 'editExam']);
    Route::post('/admin/examination/edit-exam/{id}', [ExaminationController::class, 'updateExam']);
    Route::get('/admin/examination/delete-exam/{id}', [ExaminationController::class, 'deleteExam']);

    Route::get('/admin/examination/exam-schedule', [ExaminationController::class, 'examSchedule']);
    Route::post('/admin/examination/insert-exam-schedule', [ExaminationController::class, 'insertExamSchedule']);

    Route::get('/admin/examination/mark-register', [ExaminationController::class, 'markRegister']);
    Route::post('/admin/examination/submit-mark-register', [ExaminationController::class, 'submitMarkRegister']);
    Route::post('/admin/examination/single-submit-mark-register', [ExaminationController::class, 'singleSubmitMarkRegister']);

    //Mark Grade
    Route::get('/admin/examination/mark-grade', [ExaminationController::class, 'listMarkGrade']);
    Route::get('/admin/examination/mark-grade/add', [ExaminationController::class, 'addMarkGrade']);
    Route::post('/admin/examination/mark-grade/add', [ExaminationController::class, 'insertMarkGrade']);
    Route::get('/admin/examination/mark-grade/edit/{id}', [ExaminationController::class, 'editMarkGrade']);
    Route::post('/admin/examination/mark-grade/edit/{id}', [ExaminationController::class, 'updateMarkGrade']);
    Route::get('/admin/examination/mark-grade/delete/{id}', [ExaminationController::class, 'deleteMarkGrade']);
});



Route::group(['middleware' => 'teacher'], function () {
    Route::get('/teacher/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/teacher/change-password', [UserController::class, 'changePassword']);
    Route::post('/teacher/change-password', [UserController::class, 'updateChangePassword']);
    Route::get('/teacher/my-account', [UserController::class, 'myAccount']);
    Route::get('/teacher/my-class-subject', [AssignClassTeacherController::class, 'myClassSubject']);
    Route::get('/teacher/my-student', [StudentController::class, 'myStudent']);
    Route::get('/teacher/notice-board', [CommunicateController::class, 'noticeBoardTeacher']);


    //HOMEWORK
    Route::get('/teacher/homework-list', [HomeworkController::class, 'homeworkTeacher']);
    Route::get('/teacher/homework/create-homework', [HomeworkController::class, 'createHomeworkTeacher']);
    Route::post('/teacher/homework/create-homework', [HomeworkController::class, 'insertHomeworkTeacher']);
    Route::post('teacher/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject']);
    // Route::get('/teacher/homework/view-homework/{id}', [HomeworkController::class, 'viewHomework']);
    Route::get('/teacher/homework/edit-homework/{id}', [HomeworkController::class, 'editHomeworkTeacher']);
    Route::post('/teacher/homework/edit-homework/{id}', [HomeworkController::class, 'updateHomeworkTeacher']);
    Route::get('/teacher/homework/delete-homework/{id}', [HomeworkController::class, 'deleteHomeworkTeacher']);
    Route::get('/teacher/homework/submitted-homework/{id}', [HomeworkController::class, 'teacherSubmittedHomework']);

    //Teacher Timetable
    Route::get('/teacher/my-class-subject/class-timetable/{class_id}/{subject_id}', [ClassTimetableController::class, 'timetableTeacher']);

    //Exam Timetable
    Route::get('/teacher/exam-timetable', [ExaminationController::class, 'examTimetableTeacher']);

    //Mark Register
    Route::get('/teacher/mark-register', [ExaminationController::class, 'markRegisterTeacher']);
    Route::post('/teacher/submit-mark-register', [ExaminationController::class, 'submitMarkRegister']);
    Route::post('/teacher/single-submit-mark-register', [ExaminationController::class, 'singleSubmitMarkRegister']);
});


Route::group(['middleware' => 'student'], function () {
    Route::get('/student/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('/student/change-password', [UserController::class, 'changePassword']);
    Route::post('/student/change-password', [UserController::class, 'updateChangePassword']);
    Route::get('/student/my-account', [UserController::class, 'MyAccount']);
    Route::get('/student/my-subject', [SubjectController::class, 'MySubject']);
    Route::get('/student/notice-board', [CommunicateController::class, 'noticeBoardStudent']);

    //Student Homework
    Route::get('/student/my-homework', [HomeworkController::class, 'homeworkStudent']);
    Route::get('/student/homework/submit-homework/{id}', [HomeworkController::class, 'submitHomework']);
    Route::post('/student/homework/submit-homework/{id}', [HomeworkController::class, 'submitHomeworkInsert']);
    Route::get('/student/homework/my-submitted-homework', [HomeworkController::class, 'studentSubmittedHomework']);

    //Class Timetable
    Route::get('/student/class-timetable', [ClassTimetableController::class, 'timetableStudent']);

    //Exam Timetable
    Route::get('/student/exam-timetable', [ExaminationController::class, 'examTimetable']);

    //Exam Result
    Route::get('/student/my-exam-result', [ExaminationController::class, 'myExamResult']);
});



Route::group(['middleware' => 'parent'], function () {
    Route::get('/parent/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/parent/change-password', [UserController::class, 'changePassword']);
    Route::post('/parent/change-password', [UserController::class, 'updateChangePassword']);
    Route::get('/parent/my-account', [UserController::class, 'parentAccount']);
    Route::get('/parent/my-student', [ParentController::class, 'myStudentParent']);
    Route::get('/parent/my-student/subject/{student_id}', [SubjectController::class, 'parentStudentSubject']);
    Route::get('/parent/notice-board', [CommunicateController::class, 'noticeBoardParent']);
    Route::get('/parent/my-student-notice-board', [CommunicateController::class, 'myStudentNoticeBoard']);
    Route::get('/parent/my-student/homework/{id}', [HomeworkController::class, 'homeworkStudentParent']);
    Route::get('/parent/my-student/submitted-homework/{id}', [HomeworkController::class, 'submittedHomeworkStudentParent']);

    Route::get('/parent/my-student/exam-timetable/{id}', [ExaminationController::class, 'examTimetableParent']);
    Route::get('/parent/my-student/exam-result/{id}', [ExaminationController::class, 'examResultParent']);
    Route::get('/parent/my-student/subject/class-timetable/{class_id}/{subject_id}/{student_id}', [ClassTimetableController::class, 'timetableParent']);
});
