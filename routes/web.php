<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
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


Route::get('/', [CustomAuthController::class, 'index']);
Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('/custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('/signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::get('/registration', [CustomAuthController::class, 'registration'])->name('register');
Route::post('/custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:ADMIN']], function () {
    Route::get('/create-admin', [CustomAuthController::class, 'createAdmin'])->name('create_admin');
    Route::get('/create-teacher', [CustomAuthController::class, 'createTeacher'])->name('create_teacher');
    Route::post('/create-admin', [CustomAuthController::class, 'createAdminCustom'])->name('create_admin.custom');
    Route::post('/create-teacher', [CustomAuthController::class, 'createTeacherCustom'])->name('create_teacher.custom');

    Route::get('/courses/create', [CourseController::class, 'create'])->name('create_course');
    Route::post('/courses/create', [CourseController::class, 'store'])->name('store_course');
    Route::get('/courses/{courseId}/edit', [CourseController::class, 'edit'])->name('edit_course');
    Route::post('/courses/update', [CourseController::class, 'update'])->name('update_course');
    Route::post('/courses/delete', [CourseController::class, 'destroy'])->name('delete_course');

    Route::get('/courses/{courseId}/receipt-fee', [AdminController::class, 'createReceiptFee'])->name('create_receipt_fee');
    Route::post('/courses/{courseId}/receipt-fee', [AdminController::class, 'storeReceiptFee'])->name('store_receipt_fee');
    Route::post('/update-account', [AdminController::class, 'updateAdminCustom'])->name('admin.update_account');
    Route::get('/users/{userId}/edit-admin', [AdminController::class, 'editAdmin'])->name('edit_admin');
    Route::post('/users/{userId}/update-admin', [AdminController::class, 'updateAdminInfoCustom'])->name('update_admin');

    Route::get('/users/{userId}/edit-teacher', [TeacherController::class, 'editTeacher'])->name('edit_teacher');
    Route::post('/users/{userId}/update-teacher', [TeacherController::class, 'updateTeacherInfoCustom'])->name('update_teacher');

    Route::post('/users/delete', [UserController::class, 'destroy'])->name('delete_user');
});

Route::group(['prefix' => 'teacher', 'middleware' => ['auth', 'role:TEACHER']], function () {
    Route::post('/update-account', [TeacherController::class, 'updateTeacherCustom'])->name('teacher.update_account');
    Route::get('/courses/{courseId}/attendance', [TeacherController::class, 'createCourseAttendance'])->name('create_attendance');
    Route::post('/courses/attendance', [TeacherController::class, 'storeAttendance'])->name('store_attendance');
    Route::post('/courses/end', [TeacherController::class, 'endCourse'])->name('end_course');
});

Route::group(['prefix' => 'student', 'middleware' => ['auth', 'role:STUDENT']], function () {
    Route::post('/update-account', [StudentController::class, 'updateStudentCustom'])->name('student.update_account');
    Route::get('/courses/{courseId}/register', [StudentController::class, 'registerCourse'])->name('register_course');
    Route::post('/courses/{courseId}/register', [StudentController::class, 'registerCourseCustom'])->name('register_course.custom');
});

Route::group(['middleware' => ['auth', 'role:ADMIN|TEACHER']], function () {
    Route::get('/users/create-student', [CustomAuthController::class, 'createStudent'])->name('create_student');
    Route::post('/users/create-student', [CustomAuthController::class, 'createStudentCustom'])->name('create_student.custom');

    Route::get('/users/{userId}/edit-student', [StudentController::class, 'editStudent'])->name('edit_student');
    Route::post('/users/{userId}/update-student', [StudentController::class, 'updateStudentInfoCustom'])->name('update_student');

    Route::get('/courses/{courseId}/manage-session', [CourseController::class, 'showManageSession'])->name('show_manage_session');
});

Route::group(['middleware' => ['auth', 'role:TEACHER|STUDENT']], function () {
    Route::get('/courses/your-course', [CourseController::class, 'showPersonalCourses'])->name('show_personal_courses');
});

Route::group(['middleware' => ['auth', 'role:ADMIN|TEACHER|STUDENT']], function () {
    Route::get('/courses/list', [CourseController::class, 'index'])->name('course_list');
    Route::get('/courses/{courseId}/info', [CourseController::class, 'showCourseInfo'])->name('course_info');
    Route::get('/personal-courses/{courseId}/info', [CourseController::class, 'showCourseInfo'])->name('personal.course_info');

    Route::get('/users/admin', [AdminController::class, 'index'])->name('admin_list');
    Route::get('/users/admin/{userId}/info', [AdminController::class, 'show'])->name('admin_info');

    Route::get('/users/teacher', [TeacherController::class, 'index'])->name('teacher_list');
    Route::get('/users/teacher/{userId}/info', [TeacherController::class, 'show'])->name('teacher_info');

    Route::get('/users/student', [StudentController::class, 'index'])->name('student_list');
    Route::get('/users/student/{userId}/info', [StudentController::class, 'show'])->name('student_info');

    Route::get('/account/edit', [UserController::class, 'editAccount'])->name('edit_account');
});




// Route::get('laydulieu', function () {
//     $data = DB::table('users')->get();
//     print_r($data);
// });
