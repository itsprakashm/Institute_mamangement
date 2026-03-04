<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;
// use App\Http\Controllers\CourseController;
// use App\Http\Controllers\SectionController;
// use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\StudentPortalController;
use App\Http\Controllers\ReportController;

// ... other imports

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ─── Auth Routes (Guest Only) ───
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ─── Protected Routes (Auth Required) ───
Route::middleware('auth')->group(function () {

    // Dashboard Pages
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');

    /*
    Route::get('/dashboard-2', function () {
        return view('dashboard.index2');
    })->name('dashboard.student');

    Route::get('/dashboard-3', function () {
        return view('dashboard.index3');
    })->name('dashboard.teacher');

    Route::get('/dashboard-4', function () {
        return view('dashboard.index4');
    })->name('dashboard.parent');

    Route::get('/dashboard-5', function () {
        return view('dashboard.index5');
    })->name('dashboard.lms');
    */

    // Student Pages
    Route::resource('students', StudentController::class);

    // Batch Pages
    Route::resource('batches', BatchController::class)->except(['show']);

    /*
    // Teacher Pages
    Route::get('/teachers/add', function () {
        return view('teachers.add');
    })->name('teachers.add');

    Route::get('/teachers/list', function () {
        return view('teachers.list');
    })->name('teachers.list');

    Route::get('/teachers/edit', function () {
        return view('teachers.edit');
    })->name('teachers.edit');

    Route::get('/teachers/details', function () {
        return view('teachers.details');
    })->name('teachers.details');

    Route::get('/teachers/timetable', function () {
        return view('teachers.timetable');
    })->name('teachers.timetable');
    */

    /*
    // Guardian Pages
    Route::get('/guardians/add', function () {
        return view('guardians.add');
    })->name('guardians.add');

    Route::get('/guardians/list', function () {
        return view('guardians.list');
    })->name('guardians.list');

    Route::get('/guardians/edit', function () {
        return view('guardians.edit');
    })->name('guardians.edit');

    Route::get('/guardians/details', function () {
        return view('guardians.details');
    })->name('guardians.details');
    */

    // Class Pages
    Route::resource('classes', ClassController::class)->except(['show']);

    /*
    Route::get('/classes/section', [SectionController::class, 'index'])->name('sections.index');
    Route::post('/classes/section', [SectionController::class, 'store'])->name('sections.store');
    Route::put('/classes/section/{id}', [SectionController::class, 'update'])->name('sections.update')->where('id', '[0-9]+');
    Route::delete('/classes/section/{id}', [SectionController::class, 'destroy'])->name('sections.destroy')->where('id', '[0-9]+');

    Route::get('/classes/subject', [SubjectController::class, 'index'])->name('subjects.index');
    Route::post('/classes/subject', [SubjectController::class, 'store'])->name('subjects.store');
    Route::put('/classes/subject/{id}', [SubjectController::class, 'update'])->name('subjects.update')->where('id', '[0-9]+');
    Route::delete('/classes/subject/{id}', [SubjectController::class, 'destroy'])->name('subjects.destroy')->where('id', '[0-9]+');

    Route::get('/classes/room', function () {
        return view('classes.room');
    })->name('classes.room');
    */

    /*
    // Exam Pages
    Route::get('/exams/exam', function () {
        return view('exams.exam');
    })->name('exams.exam');

    Route::get('/exams/schedule', function () {
        return view('exams.schedule');
    })->name('exams.schedule');

    Route::get('/exams/result', function () {
        return view('exams.result');
    })->name('exams.result');
    */

    // Fees Pages
    Route::get('/fees', [FeeController::class, 'index'])->name('fees.index');
    Route::get('/fees/create-structure', [FeeController::class, 'createStructure'])->name('fees.create-structure');
    Route::post('/fees/store-structure', [FeeController::class, 'storeStructure'])->name('fees.store-structure');
    Route::get('/fees/collect', [FeeController::class, 'collect'])->name('fees.collect');
    Route::post('/fees/generate', [FeeController::class, 'generateFee'])->name('fees.generate');
    Route::post('/fees/mark-paid/{id}', [FeeController::class, 'markPaid'])->name('fees.mark-paid');
    Route::get('/fees/report', [FeeController::class, 'report'])->name('fees.report');

    // Attendance Pages
    Route::get('/attendance/mark', [AttendanceController::class, 'mark'])->name('attendance.mark');
    Route::post('/attendance/save', [AttendanceController::class, 'save'])->name('attendance.save');
    Route::get('/attendance/report', [AttendanceController::class, 'report'])->name('attendance.report');

    /*
    // Leave Pages
    Route::get('/leaves/types', function () {
        return view('leaves.types');
    })->name('leaves.types');

    Route::get('/leaves/request', function () {
        return view('leaves.request');
    })->name('leaves.request');

    // Certificate
    Route::get('/certificate', function () {
        return view('pages.certificate');
    })->name('certificate');
    */

    // Announcement Pages
    Route::resource('announcements', AnnouncementController::class)->only(['index', 'create', 'store', 'destroy']);

    // Activity Logs
    Route::get('/logs', [ActivityLogController::class, 'index'])->name('logs.index');

    // Student Portal
    Route::get('/student-portal/dashboard', [StudentPortalController::class, 'dashboard'])->name('student-portal.dashboard');
    Route::get('/student-portal/profile', [StudentPortalController::class, 'profile'])->name('student-portal.profile');
    Route::get('/student-portal/attendance', [StudentPortalController::class, 'attendance'])->name('student-portal.attendance');
    Route::get('/student-portal/fees', [StudentPortalController::class, 'fees'])->name('student-portal.fees');

    // Reports
    Route::get('/reports/students', [ReportController::class, 'students'])->name('reports.students');
    Route::get('/reports/attendance', [ReportController::class, 'attendance'])->name('reports.attendance');
    Route::get('/reports/fees', [ReportController::class, 'fees'])->name('reports.fees');

    /*
    // Library Pages
    Route::get('/library/books', function () {
        return view('library.books');
    })->name('library.books');

    Route::get('/library/members', function () {
        return view('library.members');
    })->name('library.members');

    Route::get('/library/member-details', function () {
        return view('library.member-details');
    })->name('library.member-details');

    Route::get('/library/issue-return', function () {
        return view('library.issue-return');
    })->name('library.issue-return');
    */

    /*
    // Accounts Pages
    Route::get('/accounts/income-head', function () {
        return view('accounts.income-head');
    })->name('accounts.income-head');

    Route::get('/accounts/income-list', function () {
        return view('accounts.income-list');
    })->name('accounts.income-list');

    Route::get('/accounts/expense-head', function () {
        return view('accounts.expense-head');
    })->name('accounts.expense-head');

    Route::get('/accounts/expense-list', function () {
        return view('accounts.expense-list');
    })->name('accounts.expense-list');

    Route::get('/accounts/transaction', function () {
        return view('accounts.transaction');
    })->name('accounts.transaction');
    */

    /*
    // HRM Pages
    Route::get('/hrm/employee-list', function () {
        return view('hrm.employee-list');
    })->name('hrm.employee-list');

    Route::get('/hrm/employee-details', function () {
        return view('hrm.employee-details');
    })->name('hrm.employee-details');

    Route::get('/hrm/add-employee', function () {
        return view('hrm.add-employee');
    })->name('hrm.add-employee');

    Route::get('/hrm/payroll', function () {
        return view('hrm.payroll');
    })->name('hrm.payroll');

    Route::get('/hrm/designation', function () {
        return view('hrm.designation');
    })->name('hrm.designation');

    Route::get('/hrm/department', function () {
        return view('hrm.department');
    })->name('hrm.department');
    */

    /*
    // Other Pages
    Route::get('/notice-board', function () {
        return view('pages.notice-board');
    })->name('notice-board');

    Route::get('/event', function () {
        return view('pages.event');
    })->name('event');

    Route::get('/message', function () {
        return view('pages.message');
    })->name('message');

    Route::get('/subscription-plan', function () {
        return view('pages.subscription-plan');
    })->name('subscription-plan');

    Route::get('/role-access', function () {
        return view('pages.role-access');
    })->name('role-access')->middleware('role:admin');

    Route::get('/assign-role', function () {
        return view('pages.assign-role');
    })->name('assign-role')->middleware('role:admin');
    */

    /*
    // Settings Pages
    Route::get('/settings/general', function () {
        return view('settings.general');
    })->name('settings.general');

    Route::get('/settings/notification', function () {
        return view('settings.notification');
    })->name('settings.notification');

    Route::get('/settings/currencies', function () {
        return view('settings.currencies');
    })->name('settings.currencies');

    Route::get('/settings/languages', function () {
        return view('settings.languages');
    })->name('settings.languages');
    */

}); // End auth middleware group

/*
// Register (guest)
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
*/
