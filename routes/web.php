<?php

use App\fees;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubjectController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/profile/edit', 'HomeController@profileEdit')->name('profile.edit');
Route::put('/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::get('/profile/changepassword', 'HomeController@changePasswordForm')->name('profile.change.password');
Route::post('/profile/changepassword', 'HomeController@changePassword')->name('profile.changepassword');

//*Student routes responsible for search the students connected by grade
Route::get('/get-students-by-class/{classId}', 'StudentController@getStudentsByClass');

Route::group(['middleware' => ['auth','role:Admin']], function ()
{
    Route::get('/roles-permissions', 'RolePermissionController@roles')->name('roles-permissions');
    Route::get('/role-create', 'RolePermissionController@createRole')->name('role.create');
    Route::post('/role-store', 'RolePermissionController@storeRole')->name('role.store');
    Route::get('/role-edit/{id}', 'RolePermissionController@editRole')->name('role.edit');
    Route::put('/role-update/{id}', 'RolePermissionController@updateRole')->name('role.update');

    Route::get('/permission-create', 'RolePermissionController@createPermission')->name('permission.create');
    Route::post('/permission-store', 'RolePermissionController@storePermission')->name('permission.store');
    Route::get('/permission-edit/{id}', 'RolePermissionController@editPermission')->name('permission.edit');
    Route::put('/permission-update/{id}', 'RolePermissionController@updatePermission')->name('permission.update');

    Route::get('assign-subject-to-class/{id}', 'GradeController@assignSubject')->name('class.assign.subject');
    Route::post('assign-subject-to-class/{id}', 'GradeController@storeAssignedSubject')->name('store.class.assign.subject');

    Route::resource('assignrole', 'RoleAssign');
    Route::resource('classes', 'GradeController');
    Route::resource('subject', 'SubjectController');
    Route::resource('teacher', 'TeacherController');
    Route::resource('parents', 'ParentsController');
    Route::resource('student', 'StudentController');
    Route::get('/students', 'StudentController@index')->name('students.index');
    Route::get('attendance', 'AttendanceController@index')->name('attendance.index');
    Route::resource('academicRecord', 'AcademicRecordController');
    Route::get('/generateRecords', 'AcademicRecordController@generateRecords')->name('generateRecords');

    //*User Routes
    Route::get('/user', 'UserController@create')->name('user.create');

    //?Payments routes
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/allPayments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/filter', [PaymentController::class, 'filter'])->name('payments.filter');

    //?Route to filter the fees using the attribute year
    Route::get('/fees/filter', 'AcademicRecordController@feesFilter')->name('feesFilter');
});

Route::group(['middleware' => ['auth','role:Teacher']], function ()
{
    Route::post('attendance', 'AttendanceController@store')->name('teacher.attendance.store');
    Route::get('attendance-create/{classid}', 'AttendanceController@createByTeacher')->name('teacher.attendance.create');

    //?Start with the notes route
    Route::get('/notes', [NoteController::class, 'index'])->name('student.notes');
    Route::get('/filter-note', [NoteController::class, 'filterByClass'])->name('filterNote');
    Route::get('/addNotes/{id}', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/storeNotes', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/deleteNotes/{id}', [NoteController::class, 'delete'])->name('notes.delete');
    Route::post('/updateNotes/{id}', [NoteController::class, 'update'])->name('notes.update');

    //?Subject Route
    Route::get('/subjectTeacher/{id}', [SubjectController::class, 'teacher'])->name('subject.teacher');

    //?Start with files routes
    //*Add a class route here to make beautiful process in view
    Route::get('/teacherClasses/{id}', [FileController::class, 'classes'])->name('teacherClasses');
    Route::get('/files/{id}', [FileController::class, 'files'])->name('files');
    Route::get('/teacherFile/{id}', [FileController::class, 'index'])->name('teacherFile');
    Route::post('/storeFiles', [FileController::class, 'store'])->name('storeFiles');
    Route::get('/editFiles/{id}', [FileController::class, 'edit'])->name('editFiles');
    Route::post('/updateFiles/{id}', [FileController::class, 'update'])->name('updateFiles');
    Route::get('/deleteFiles/{id}', [FileController::class, 'delete'])->name('deleteFiles');
});

Route::group(['middleware' => ['auth','role:Parent']], function ()
{
    Route::get('attendance/{attendance}', 'AttendanceController@show')->name('attendance.show');
});

Route::group(['middleware' => ['auth','role:Student']], function () {
    //?Academic Record routes
    Route::get('/studentFee/{id}', 'StudentController@generateFee')->name('studentFee');

    //?Attendance Report routes
    Route::get('/studentAttendance/{id}', 'AttendanceController@studentAttendance')->name('studentAttendance');

    //?Classes Report routes
    Route::get('/studentClass/{id}', 'GradeController@studentClass')->name('studentClass');

    //?Notes Students routs
    Route::get('/studentNotes/{id}', [NoteController::class, 'student'])->name('notes.students');

    //?Student File Section
    Route::get('/studentClasses/{id}', [FileController::class, 'studentClasses'])->name('studentClasses');
    Route::get('/studentFiles/{id}', [FileController::class, 'studentFiles'])->name('studentFiles');
});
