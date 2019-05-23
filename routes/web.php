<?php

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

/*Auth Routes*/
Auth::routes();

//test taker routes
Route::get('/list_test_taker','UserController@list_test_taker')->name('list_test_taker');
Route::get('/add_test_taker','UserController@add_test_taker')->name('add_test_taker');
Route::post('/store_test_taker','UserController@store_test_taker')->name('store_test_taker');
Route::get('/delete_test_taker/{id}','UserController@delete_test_taker')->name('delete_test_taker');
Route::get('/view_test_taker/{id}','UserController@view_test_taker')->name('view_test_taker');
Route::get('/edit_test_taker/{id}','UserController@edit_test_taker')->name('edit_test_taker');
Route::post('/update_test_taker/{id}','UserController@update_test_taker')->name('update_test_taker');
//placement test
Route::get('/placement_test_list','UserController@placement_test_list')->name('placement_test_list');
Route::get('/placement_test_delete/{id}','UserController@placement_test_delete')->name('placement_test_delete');
Route::post('/placement_test_store','UserController@placement_test_store')->name('placement_test_store');
Route::get('/placement_test_edit/{id}','UserController@placement_test_edit')->name('placement_test_edit');
Route::post('/placement_test_update/{id}','UserController@placement_test_update')->name('placement_test_update');

//todo list
Route::get('/todo_list','UserController@todo_list')->name('todo_list');
Route::post('/todo_store','UserController@todo_store')->name('todo_store');
Route::get('/todo_add','UserController@todo_add')->name('todo_add');
Route::get('delete/todo/{id}','UserController@delete_notice')->name('delete_todo');

/*for Dashboard's*/
Route::get('/',                             ['as' => 'home',    'uses' => 'HomeController@index']);

/* Roles Routes */
Route::get('role',                    ['as' => 'role',                  'middleware' => ['ability:super-admin,role-index'],         'uses' => 'RoleController@index']);
Route::get('role/add',                ['as' => 'role.add',              'middleware' => ['ability:super-admin,role-add'],           'uses' => 'RoleController@create']);
Route::post('role/store',             ['as' => 'role.store',            'middleware' => ['ability:super-admin,role-add'],           'uses' => 'RoleController@store']);
Route::get('role/{id}/edit',          ['as' => 'role.edit',             'middleware' => ['ability:super-admin,role-edit'],          'uses' => 'RoleController@edit']);
Route::post('role/{id}/update',       ['as' => 'role.update',           'middleware' => ['ability:super-admin,role-edit'],          'uses' => 'RoleController@update']);
Route::get('role/{id}/view',          ['as' => 'role.view',             'middleware' => ['ability:super-admin,role-view'],          'uses' => 'RoleController@show']);
Route::get('role/{id}/delete',        ['as' => 'role.delete',           'middleware' => ['ability:super-admin,role-delete'],        'uses' => 'RoleController@destroy']);

/* User Routes */
Route::get('user',                    ['as' => 'user',                  'middleware' => ['ability:super-admin,user-index'],             'uses' => 'UserController@index']);
Route::get('user/add',                ['as' => 'user.add',              'middleware' => ['ability:super-admin,user-add'],               'uses' => 'UserController@add']);
Route::post('user/store',             ['as' => 'user.store',            'middleware' => ['ability:super-admin,user-add'],               'uses' => 'UserController@store']);
Route::get('user/{id}/edit',          ['as' => 'user.edit',             'middleware' => ['ability:super-admin,user-edit'],              'uses' => 'UserController@edit']);
Route::post('user/{id}/update',       ['as' => 'user.update',           'middleware' => ['ability:super-admin,user-edit'],              'uses' => 'UserController@update']);
Route::get('user/{id}/delete',        ['as' => 'user.delete',           'middleware' => ['ability:super-admin,user-delete'],            'uses' => 'UserController@delete']);
Route::get('user/{id}/active',        ['as' => 'user.active',           'middleware' => ['ability:super-admin,user-active'],            'uses' => 'UserController@Active']);
Route::get('user/{id}/in-active',     ['as' => 'user.in-active',        'middleware' => ['ability:super-admin,user-in-active'],         'uses' => 'UserController@inActive']);
Route::post('user/bulk-action',       ['as' => 'user.bulk-action',      'middleware' => ['ability:super-admin,user-bulk-action'],       'uses' => 'UserController@bulkAction']);

/*user-student route group*/
Route::group(['prefix' => 'user-student/',          'as' => 'user-student',       'namespace' => 'UserStudent\\'], function () {
    Route::get('',                      ['as' => '',                    'uses' => 'HomeController@index']);
    Route::get('profile',               ['as' => '.profile',            'uses' => 'HomeController@profile']);
    Route::post('{id}/password',        ['as' => '.password',           'uses' => 'HomeController@password']);
    Route::get('fees',                  ['as' => '.fees',               'uses' => 'HomeController@fees']);
    Route::get('library',               ['as' => '.library',            'uses' => 'HomeController@library']);
    Route::get('attendance',            ['as' => '.attendance',         'uses' => 'HomeController@attendance']);

    Route::get('exams',                                                            ['as' => '.exams',               'uses' => 'HomeController@exams']);
    Route::get('exam-schedule/{year}/{month}/{exam}/{faculty}/{semester}',         ['as' => '.exam-schedule',       'uses' => 'HomeController@examSchedule']);
    Route::get('exam-admit-card/{year}/{month}/{exam}/{faculty}/{semester}',       ['as' => '.exam-admit-card',     'uses' => 'HomeController@admitCard']);
    Route::get('exam-score/{year}/{month}/{exam}/{faculty}/{semester}',            ['as' => '.exam-score',          'uses' => 'HomeController@examScore']);

    Route::get('hostel',                ['as' => '.hostel',             'uses' => 'HomeController@hostel']);
    Route::get('transport',             ['as' => '.transport',          'uses' => 'HomeController@transport']);
    Route::get('subject',               ['as' => '.subject',            'uses' => 'HomeController@subject']);
    Route::get('notice',                ['as' => '.notice',             'uses' => 'HomeController@notice']);
    Route::get('download',              ['as' => '.download',             'uses' => 'HomeController@download']);

    Route::get('assignment',                                    ['as' => '.assignment',                          'uses' => 'HomeController@assignment']);
    Route::get('assignment/answer/{id}/add',                    ['as' => '.assignment.answer.add',               'uses' => 'HomeController@addAnswer']);
    Route::post('assignment/answer/store',                      ['as' => '.assignment.answer.store',             'uses' => 'HomeController@storeAnswer']);
    Route::get('assignment/answer/{id}/edit',                   ['as' => '.assignment.answer.edit',              'uses' => 'HomeController@editAnswer']);
    Route::post('assignment/answer/{id}/update',                ['as' => '.assignment.answer.update',            'uses' => 'HomeController@updateAnswer']);
    Route::get('assignment/answer/{id}/{answer}/view',         ['as' => '.assignment.answer.view',              'uses' => 'HomeController@viewAssignmentAnswer']);

});

/*Guardian User Route group*/
Route::group(['prefix' => 'user-guardian/',          'as' => 'user-guardian',       'namespace' => 'UserGuardian\\'], function () {
    /*user-student route group*/
    Route::get('',                              ['as' => '',                    'uses' => 'HomeController@index']);
    Route::get('profile',                       ['as' => '.profile',            'uses' => 'HomeController@profile']);
    Route::post('{id}/password',                ['as' => '.password',           'uses' => 'HomeController@password']);
    Route::get('notice',                        ['as' => '.notice',             'uses' => 'HomeController@notice']);

    //guardian's student wise summary routes
    Route::get('students',                      ['as' => '.students',               'uses' => 'HomeController@students']);
    Route::get('students/{id}/profile',         ['as' => '.students.profile',       'uses' => 'HomeController@studentProfile']);
    Route::get('students/{id}/fees',            ['as' => '.students.fees',          'uses' => 'HomeController@fees']);
    Route::get('students/{id}/library',         ['as' => '.students.library',       'uses' => 'HomeController@library']);
    Route::get('students/{id}/attendance',      ['as' => '.students.attendance',    'uses' => 'HomeController@attendance']);
    Route::get('students/{id}/hostel',          ['as' => '.students.hostel',        'uses' => 'HomeController@hostel']);
    Route::get('students/{id}/transport',       ['as' => '.students.transport',     'uses' => 'HomeController@transport']);
    Route::get('students/{id}/subject',         ['as' => '.students.subject',       'uses' => 'HomeController@subject']);
    Route::get('students/{id}/download',        ['as' => '.students.download',      'uses' => 'HomeController@download']);

    Route::get('students/{id}/exams',                                                            ['as' => '.students.exams',               'uses' => 'HomeController@exams']);
    Route::get('students/{id}/exam-schedule/{year}/{month}/{exam}/{faculty}/{semester}',         ['as' => '.students.exam-schedule',       'uses' => 'HomeController@examSchedule']);
    Route::get('students/{id}/exam-admit-card/{year}/{month}/{exam}/{faculty}/{semester}',       ['as' => '.students.exam-admit-card',     'uses' => 'HomeController@admitCard']);
    Route::get('students/{id}/exam-score/{year}/{month}/{exam}/{faculty}/{semester}',            ['as' => '.students.exam-score',          'uses' => 'HomeController@examScore']);

    Route::get('students/{id}assignment/',                                                 ['as' => '.students.assignment',                          'uses' => 'HomeController@assignment']);
    Route::get('students/{id}/assignment/answer/{assignment}/{answer}/view',               ['as' => '.students.assignment.answer.view',              'uses' => 'HomeController@viewAssignmentAnswer']);

});

/*user-Staff route group*/
Route::group(['prefix' => 'user-staff/',          'as' => 'user-staff',       'namespace' => 'UserStaff\\'], function () {
    Route::get('',                      ['as' => '',                    'uses' => 'HomeController@index']);
    Route::post('{id}/password',        ['as' => '.password',           'uses' => 'HomeController@password']);
    Route::get('payroll',               ['as' => '.payroll',             'uses' => 'HomeController@payroll']);
    Route::get('library',               ['as' => '.library',            'uses' => 'HomeController@library']);
    Route::get('attendance',            ['as' => '.attendance',         'uses' => 'HomeController@attendance']);
    Route::get('exam-score',            ['as' => '.exam-score',         'uses' => 'HomeController@examScore']);
    Route::get('hostel',                ['as' => '.hostel',             'uses' => 'HomeController@hostel']);
    Route::get('transport',             ['as' => '.transport',          'uses' => 'HomeController@transport']);
    Route::get('subject',               ['as' => '.subject',            'uses' => 'HomeController@subject']);
    Route::get('notice',                ['as' => '.notice',             'uses' => 'HomeController@notice']);

    /*Student Attendance*/
    Route::get('student-attendance/add',               ['as' => '.student-attendance.add',                'middleware' => ['ability:super-admin,student-attendance-add'],             'uses' => 'HomeController@addStudentAttendance']);
    Route::post('student-attendance/store',            ['as' => '.student-attendance.store',              'middleware' => ['ability:super-admin,student-attendance-add'],             'uses' => 'HomeController@storeStudentAttendance']);
    Route::post('student-html',                        ['as' => '.student-attendance.student-html',                                                                                   'uses' => 'HomeController@studentHtmlRow']);

    /*Assignment*/
    Route::get('assignment',                           ['as' => '.assignment',                   'middleware' => ['ability:super-admin,assignment-index'],               'uses' => 'HomeController@assignment']);

});

/*Students Grouping*/
Route::group(['prefix' => 'student/',                                   'as' => 'student',                                     'namespace' => 'Student\\'], function () {

    Route::get('',                          ['as' => '',                         'middleware' => ['ability:super-admin,student-index'],                  'uses' => 'StudentController@index']);
    Route::get('registration',              ['as' => '.registration',            'middleware' => ['ability:super-admin,student-registration'],           'uses' => 'StudentController@registration']);
    Route::post('register',                 ['as' => '.register',                'middleware' => ['ability:super-admin,student-register'],               'uses' => 'StudentController@register']);
    Route::get('{id}/view',                 ['as' => '.view',                    'middleware' => ['ability:super-admin,student-view'],                   'uses' => 'StudentController@view']);
    Route::get('{id}/edit',                 ['as' => '.edit',                    'middleware' => ['ability:super-admin,student-edit'],                   'uses' => 'StudentController@edit']);
    Route::post('{id}/update',              ['as' => '.update',                  'middleware' => ['ability:super-admin,student-edit'],                    'uses' => 'StudentController@update']);
    Route::get('{id}/delete',               ['as' => '.delete',                  'middleware' => ['ability:super-admin,student-delete'],                 'uses' => 'StudentController@delete']);
    Route::post('bulk-action',              ['as' => '.bulk-action',             'middleware' => ['ability:super-admin,student-bulk-action'],            'uses' => 'StudentController@bulkAction']);
    Route::get('{id}/active',               ['as' => '.active',                  'middleware' => ['ability:super-admin,student-active'],                 'uses' => 'StudentController@Active']);
    Route::get('{id}/in-active',            ['as' => '.in-active',               'middleware' => ['ability:super-admin,student-in-active'],              'uses' => 'StudentController@inActive']);
    Route::post('find-semester',            ['as' => '.find-semester',                                                                                   'uses' => 'StudentController@findSemester']);
    Route::post('academicInfo-html',        ['as' => '.academicInfo-html',                                                                               'uses' => 'StudentController@academicInfoHtml']);
    Route::get('{id}/delete-academicInfo',  ['as' => '.delete-academicInfo',     'middleware' => ['ability:super-admin,student-delete-academic-info'],   'uses' => 'StudentController@deleteAcademicInfo']);
    Route::get('guardian-name-autocomplete',  ['as' => '.guardian-name-autocomplete',                                                                     'uses' => 'StudentController@guardianNameAutocomplete']);
    Route::post('guardianInfo-html',            ['as' => '.guardianInfo-html',                                                                            'uses' => 'StudentController@guardianInfo']);

    Route::get('import',                      ['as' => '.import',             'middleware' => ['ability:super-admin,student-add'],           'uses' => 'StudentController@importStudent']);
    Route::post('import',                     ['as' => '.bulk.import',        'middleware' => ['ability:super-admin,student-add'],             'uses' => 'StudentController@handleImportStudent']);

    /*Student transfer */
    Route::get('transfer',                  ['as' => '.transfer',                  'middleware' => ['ability:super-admin,student-transfer'],      'uses' => 'StudentController@transfer']);
    Route::post('transfering',              ['as' => '.transfering',               'middleware' => ['ability:super-admin,student-transfer'],      'uses' => 'StudentController@transfering']);

    /*Student login access*/
    Route::post('user/create',             ['as' => '.user.create',                  'middleware' => ['ability:super-admin,user-add'],                    'uses' => 'StudentController@createUser']);
    Route::post('{id}/user/update',        ['as' => '.user.update',                  'middleware' => ['ability:super-admin,user-edit'],                   'uses' => 'StudentController@updateUser']);
    Route::get('{id}/user/active',         ['as' => '.user.active',                  'middleware' => ['ability:super-admin,user-active'],                 'uses' => 'StudentController@activeUser']);
    Route::get('{id}/user/in-active',      ['as' => '.user.in-active',               'middleware' => ['ability:super-admin,user-in-active'],              'uses' => 'StudentController@inActiveUser']);
    Route::get('{id}/user/delete',         ['as' => '.user.delete',                  'middleware' => ['ability:super-admin,user-delete'],                 'uses' => 'StudentController@deleteUser']);

    /*Guardian login access*/
    Route::post('guardian/user/create',             ['as' => '.guardian.user.create',                  'middleware' => ['ability:super-admin,user-add'],                    'uses' => 'StudentController@createUser']);
    Route::post('guardian/{id}/user/update',        ['as' => '.guardian.user.update',                  'middleware' => ['ability:super-admin,user-edit'],                   'uses' => 'StudentController@updateUser']);
    Route::get('guardian/{id}/user/active',         ['as' => '.guardian.user.active',                  'middleware' => ['ability:super-admin,user-active'],                 'uses' => 'StudentController@activeUser']);
    Route::get('guardian/{id}/user/in-active',      ['as' => '.guardian.user.in-active',               'middleware' => ['ability:super-admin,user-in-active'],              'uses' => 'StudentController@inActiveUser']);
    Route::get('guardian/{id}/user/delete',         ['as' => '.guardian.user.delete',                  'middleware' => ['ability:super-admin,user-delete'],                 'uses' => 'StudentController@deleteUser']);


    /*Student Document Upload*/
    Route::get('document',                      ['as' => '.document',                'middleware' => ['ability:super-admin,student-document-index'],      'uses' => 'DocumentController@index']);
    Route::post('document/store',               ['as' => '.document.store',          'middleware' => ['ability:super-admin,student-document-add'],      'uses' => 'DocumentController@store']);
    Route::get('document/{id}/edit',            ['as' => '.document.edit',           'middleware' => ['ability:super-admin,student-document-edit'],      'uses' => 'DocumentController@edit']);
    Route::post('document/{id}/update',         ['as' => '.document.update',         'middleware' => ['ability:super-admin,student-document-edit'],      'uses' => 'DocumentController@update']);
    Route::get('document/{id}/delete',          ['as' => '.document.delete',         'middleware' => ['ability:super-admin,student-document-delete'],      'uses' => 'DocumentController@delete']);
    Route::get('document/{id}/active',          ['as' => '.document.active',         'middleware' => ['ability:super-admin,student-document-active'],      'uses' => 'DocumentController@Active']);
    Route::get('document/{id}/in-active',       ['as' => '.document.in-active',      'middleware' => ['ability:super-admin,student-document-in-active'],      'uses' => 'DocumentController@inActive']);
    Route::post('document/bulk-action',         ['as' => '.document.bulk-action',    'middleware' => ['ability:super-admin,student-document-bulk-action'],      'uses' => 'DocumentController@bulkAction']);

    /*Student Notes Creating*/
    Route::get('note',                          ['as' => '.note',                'middleware' => ['ability:super-admin,student-note-index'],      'uses' => 'NoteController@index']);
    Route::post('note/store',                   ['as' => '.note.store',          'middleware' => ['ability:super-admin,student-note-add'],      'uses' => 'NoteController@store']);
    Route::get('note/{id}/edit',                ['as' => '.note.edit',           'middleware' => ['ability:super-admin,student-note-edit'],      'uses' => 'NoteController@edit']);
    Route::post('note/{id}/update',             ['as' => '.note.update',         'middleware' => ['ability:super-admin,student-note-edit'],      'uses' => 'NoteController@update']);
    Route::get('note/{id}/delete',              ['as' => '.note.delete',         'middleware' => ['ability:super-admin,student-note-delete'],      'uses' => 'NoteController@delete']);
    Route::get('note/{id}/active',              ['as' => '.note.active',         'middleware' => ['ability:super-admin,student-note-active'],      'uses' => 'NoteController@Active']);
    Route::get('note/{id}/in-active',           ['as' => '.note.in-active',      'middleware' => ['ability:super-admin,student-note-in-active'],      'uses' => 'NoteController@inActive']);
    Route::post('note/bulk-action',             ['as' => '.note.bulk-action',    'middleware' => ['ability:super-admin,student-note-bulk-action'],      'uses' => 'NoteController@bulkAction']);
});

/*Staff Grouping*/
Route::group(['prefix' => 'staff/',                                     'as' => 'staff',                                       'namespace' => 'Staff\\'], function () {
    /*Staff Routes*/
    Route::get('',                          ['as' => '',                    'middleware' => ['ability:super-admin,staff-index'],        'uses' => 'StaffController@index']);
    Route::get('add',                       ['as' => '.add',                'middleware' => ['ability:super-admin,staff-add'],          'uses' => 'StaffController@add']);
    Route::post('store',                    ['as' => '.store',              'middleware' => ['ability:super-admin,staff-add'],          'uses' => 'StaffController@store']);
    Route::get('{id}/edit',                 ['as' => '.edit',               'middleware' => ['ability:super-admin,staff-edit'],         'uses' => 'StaffController@edit']);
    Route::post('{id}/update',              ['as' => '.update',             'middleware' => ['ability:super-admin,staff-edit'],         'uses' => 'StaffController@update']);
    Route::get('{id}/view',                 ['as' => '.view',               'middleware' => ['ability:super-admin,staff-view'],         'uses' => 'StaffController@view']);
    Route::get('{id}/delete',               ['as' => '.delete',             'middleware' => ['ability:super-admin,staff-delete'],       'uses' => 'StaffController@delete']);
    Route::get('{id}/active',               ['as' => '.active',             'middleware' => ['ability:super-admin,staff-active'],       'uses' => 'StaffController@Active']);
    Route::get('{id}/in-active',            ['as' => '.in-active',          'middleware' => ['ability:super-admin,staff-in-active'],    'uses' => 'StaffController@inActive']);
    Route::post('bulk-action',              ['as' => '.bulk-action',        'middleware' => ['ability:super-admin,staff-bulk-action'],  'uses' => 'StaffController@bulkAction']);

    Route::get('import',                      ['as' => '.import',             'middleware' => ['ability:super-admin,staff-add'],           'uses' => 'StaffController@importStaff']);
    Route::post('import',                     ['as' => '.bulk.import',        'middleware' => ['ability:super-admin,staff-add'],             'uses' => 'StaffController@handleImportStaff']);


    /*Staff login access*/
    Route::post('user/create',             ['as' => '.user.create',                  'middleware' => ['ability:super-admin,user-add'],                    'uses' => 'StaffController@createUser']);
    Route::post('{id}/user/update',        ['as' => '.user.update',                  'middleware' => ['ability:super-admin,user-edit'],                   'uses' => 'StaffController@updateUser']);
    Route::get('{id}/user/active',         ['as' => '.user.active',                  'middleware' => ['ability:super-admin,user-active'],                 'uses' => 'StaffController@activeUser']);
    Route::get('{id}/user/in-active',      ['as' => '.user.in-active',               'middleware' => ['ability:super-admin,user-in-active'],              'uses' => 'StaffController@inActiveUser']);
    Route::get('{id}/user/delete',         ['as' => '.user.delete',                  'middleware' => ['ability:super-admin,user-delete'],                 'uses' => 'StaffController@deleteUser']);

    /*Staff Document Upload*/
    Route::get('document',                  ['as' => '.document',               'middleware' => ['ability:super-admin,staff-document-index'],       'uses' => 'DocumentController@index']);
    Route::post('document/store',           ['as' => '.document.store',         'middleware' => ['ability:super-admin,staff-document-add'],         'uses' => 'DocumentController@store']);
    Route::get('document/{id}/edit',        ['as' => '.document.edit',          'middleware' => ['ability:super-admin,staff-document-edit'],        'uses' => 'DocumentController@edit']);
    Route::post('document/{id}/update',     ['as' => '.document.update',        'middleware' => ['ability:super-admin,staff-document-edit'],        'uses' => 'DocumentController@update']);
    Route::get('document/{id}/delete',      ['as' => '.document.delete',        'middleware' => ['ability:super-admin,staff-document-delete'],      'uses' => 'DocumentController@delete']);
    Route::get('document/{id}/active',      ['as' => '.document.active',        'middleware' => ['ability:super-admin,staff-document-active'],      'uses' => 'DocumentController@Active']);
    Route::get('document/{id}/in-active',   ['as' => '.document.in-active',     'middleware' => ['ability:super-admin,staff-document-in-active'],   'uses' => 'DocumentController@inActive']);
    Route::post('document/bulk-action',     ['as' => '.document.bulk-action',   'middleware' => ['ability:super-admin,staff-document-bulk-action'], 'uses' => 'DocumentController@bulkAction']);

    /*Staff Notes Creating*/
    Route::get('note',                      ['as' => '.note',                'middleware' => ['ability:super-admin,staff-note-index'],      'uses' => 'NoteController@index']);
    Route::post('note/store',               ['as' => '.note.store',          'middleware' => ['ability:super-admin,staff-note-add'],        'uses' => 'NoteController@store']);
    Route::get('note/{id}/edit',            ['as' => '.note.edit',           'middleware' => ['ability:super-admin,staff-note-edit'],       'uses' => 'NoteController@edit']);
    Route::post('note/{id}/update',         ['as' => '.note.update',         'middleware' => ['ability:super-admin,staff-note-edit'],       'uses' => 'NoteController@update']);
    Route::get('note/{id}/delete',          ['as' => '.note.delete',         'middleware' => ['ability:super-admin,staff-note-delete'],     'uses' => 'NoteController@delete']);
    Route::get('note/{id}/active',          ['as' => '.note.active',         'middleware' => ['ability:super-admin,staff-note-acctive'],    'uses' => 'NoteController@Active']);
    Route::get('note/{id}/in-active',       ['as' => '.note.in-active',      'middleware' => ['ability:super-admin,staff-note-in-active'],   'uses' => 'NoteController@inActive']);
    Route::post('note/bulk-action',         ['as' => '.note.bulk-action',    'middleware' => ['ability:super-admin,staff-note-bulk-action'], 'uses' => 'NoteController@bulkAction']);

    /*Staff Designation*/
    Route::get('designation',                   ['as' => '.designation',                'middleware' => ['ability:super-admin,staff-designation-index'],        'uses' => 'DesignationController@index']);
    Route::post('designation/store',            ['as' => '.designation.store',          'middleware' => ['ability:super-admin,staff-designation-add'],          'uses' => 'DesignationController@store']);
    Route::get('designation/{id}/edit',         ['as' => '.designation.edit',           'middleware' => ['ability:super-admin,staff-designation-edit'],         'uses' => 'DesignationController@edit']);
    Route::post('designation/{id}/update',      ['as' => '.designation.update',         'middleware' => ['ability:super-admin,staff-designation-edit'],       'uses' => 'DesignationController@update']);
    Route::get('designation/{id}/delete',       ['as' => '.designation.delete',         'middleware' => ['ability:super-admin,staff-designation-delete'],       'uses' => 'DesignationController@delete']);
    Route::get('designation/{id}/active',       ['as' => '.designation.active',         'middleware' => ['ability:super-admin,staff-designation-active'],       'uses' => 'DesignationController@Active']);
    Route::get('designation/{id}/in-active',    ['as' => '.designation.in-active',      'middleware' => ['ability:super-admin,staff-designation-in-active'],    'uses' => 'DesignationController@inActive']);
    Route::post('designation/bulk-action',      ['as' => '.designation.bulk-action',    'middleware' => ['ability:super-admin,staff-designation-bulk-action'],  'uses' => 'DesignationController@bulkAction']);
});

/*Accounting Grouping*/
Route::group(['prefix' => 'account/',                                   'as' => 'account.',                                    'namespace' => 'Account\\'], function () {
 /*Fees Group*/
    /*Balance Fees*/
    Route::get('fees/',                    ['as' => 'fees',                          'middleware' => ['ability:super-admin,fees-index'],            'uses' => 'Fees\FeesBaseController@index']);
    Route::get('fees/balance',             ['as' => 'fees.balance',                  'middleware' => ['ability:super-admin,fees-balance'],          'uses' => 'Fees\FeesBaseController@balance']);

    /*Fee Head*/
    Route::get('fees/head',                    ['as' => 'fees.head',                  'middleware' => ['ability:super-admin,fees-head-index'],                  'uses' => 'Fees\FeesHeadController@index']);
    Route::post('fees/head/store',             ['as' => 'fees.head.store',            'middleware' => ['ability:super-admin,fees-head-add'],                    'uses' => 'Fees\FeesHeadController@store']);
    Route::get('fees/head/{id}/edit',          ['as' => 'fees.head.edit',             'middleware' => ['ability:super-admin,fees-head-edit'],                   'uses' => 'Fees\FeesHeadController@edit']);
    Route::post('fees/head/{id}/update',       ['as' => 'fees.head.update',           'middleware' => ['ability:super-admin,fees-head-edit'],                   'uses' => 'Fees\FeesHeadController@update']);
    Route::get('fees/head/{id}/delete',        ['as' => 'fees.head.delete',           'middleware' => ['ability:super-admin,fees-head-delete'],                 'uses' => 'Fees\FeesHeadController@delete']);
    Route::get('fees/head/{id}/active',        ['as' => 'fees.head.active',           'middleware' => ['ability:super-admin,fees-head-active'],                 'uses' => 'Fees\FeesHeadController@Active']);
    Route::get('fees/head/{id}/in-active',     ['as' => 'fees.head.in-active',        'middleware' => ['ability:super-admin,fees-head-in-active'],              'uses' => 'Fees\FeesHeadController@inActive']);
    Route::post('fees/head/bulk-action',       ['as' => 'fees.head.bulk-action',      'middleware' => ['ability:super-admin,fees-head-bulk-action'],            'uses' => 'Fees\FeesHeadController@bulkAction']);

    /*Fee Master*/
    Route::get('fees/master',                    ['as' => 'fees.master',                  'middleware' => ['ability:super-admin,fees-master-index'],            'uses' => 'Fees\FeesMasterController@index']);
    Route::get('fees/master/add',                ['as' => 'fees.master.add',              'middleware' => ['ability:super-admin,fees-master-add'],              'uses' => 'Fees\FeesMasterController@add']);
    Route::post('fees/master/store',             ['as' => 'fees.master.store',            'middleware' => ['ability:super-admin,fees-master-add'],              'uses' => 'Fees\FeesMasterController@store']);
    Route::get('fees/master/{id}/edit',          ['as' => 'fees.master.edit',             'middleware' => ['ability:super-admin,fees-master-edit'],             'uses' => 'Fees\FeesMasterController@edit']);
    Route::post('fees/master/{id}/update',       ['as' => 'fees.master.update',           'middleware' => ['ability:super-admin,fees-master-edit'],             'uses' => 'Fees\FeesMasterController@update']);
    Route::get('fees/master/{id}/delete',        ['as' => 'fees.master.delete',           'middleware' => ['ability:super-admin,fees-master-delete'],           'uses' => 'Fees\FeesMasterController@delete']);
    Route::post('fees/master/bulk-action',       ['as' => 'fees.master.bulk-action',      'middleware' => ['ability:super-admin,fees-master-bulk-action'],      'uses' => 'Fees\FeesMasterController@bulkAction']);
    Route::get('fees/master/{id}/active',        ['as' => 'fees.master.active',           'middleware' => ['ability:super-admin,fees-master-active'],           'uses' => 'Fees\FeesMasterController@Active']);
    Route::get('fees/master/{id}/in-active',     ['as' => 'fees.master.in-active',        'middleware' => ['ability:super-admin,fees-master-in-active'],        'uses' => 'Fees\FeesMasterController@inActive']);
    Route::post('fees/master/fee-html',          ['as' => 'fees.master.fee-html',                                                                               'uses' => 'Fees\FeesMasterController@feeHtmlRow']);

    /*Collect Fee */
    Route::get('fees/collection',                    ['as' => 'fees.collection',                  'middleware' => ['ability:super-admin,fees-collection-index'],            'uses' => 'Fees\FeesCollectionController@index']);
    Route::get('fees/collection/{id}/add',           ['as' => 'fees.collection.add',              'middleware' => ['ability:super-admin,fees-collection-add'],              'uses' => 'Fees\FeesCollectionController@add']);
    Route::post('fees/collection/store',             ['as' => 'fees.collection.store',            'middleware' => ['ability:super-admin,fees-collection-add'],              'uses' => 'Fees\FeesCollectionController@store']);
    Route::get('fees/collection/{id}/view',          ['as' => 'fees.collection.view',             'middleware' => ['ability:super-admin,fees-collection-view'],             'uses' => 'Fees\FeesCollectionController@view']);
    Route::get('fees/collection/{id}/delete',        ['as' => 'fees.collection.delete',           'middleware' => ['ability:super-admin,fees-collection-delete'],           'uses' => 'Fees\FeesCollectionController@delete']);

    /*online payment*/
    Route::post('fees/pay-with-stripe',               ['as' => 'fees.stripePayment',                 'middleware' => ['ability:super-admin,fees-payment-stripe-payment'],     'uses' => 'Fees\Payment\StripePaymentController@stripePayment']);

    Route::post('fees/payumoney-form',                 ['as' => 'fees.payumoney-form',                'middleware' => ['ability:super-admin,fees-payment-payumoney-payment'],     'uses' => 'Fees\Payment\PayumoneyPaymentController@payumoneyForm']);
    Route::post('fees/pay-with-payumoney/success',     ['as' => 'fees.payumoney.success',             'middleware' => ['ability:super-admin,fees-payment-payumoney-payment'],     'uses' => 'Fees\Payment\PayumoneyPaymentController@payumoneyPaymentSuccess']);
    Route::post('fees/pay-with-payumoney/failure',     ['as' => 'fees.payumoney.failure',              'middleware' => ['ability:super-admin,fees-payment-payumoney-payment'],     'uses' => 'Fees\Payment\PayumoneyPaymentController@payumoneyPaymentFailure']);
    //Route::post('fees/pay-with-khalti',               ['as' => 'fees.khaltiPayment',                 'middleware' => ['ability:super-admin,fees-payment-khalti-payment'],     'uses' => 'Fees\FeesCollectionController@khaltiPayment']);

    Route::post('fees/pesapal-form',                 ['as' => 'fees.pesapal-form',                      'middleware' => ['ability:super-admin,fees-payment-pesapal'],              'uses' => 'Fees\Payment\PesapalPaymentController@pesapalForm']);
    Route::post('fees/pay-with-pesapal',             ['as' => 'fees.pesapal',                           'middleware' => ['ability:super-admin,fees-payment-pesapal'],             'uses' => 'Fees\Payment\PesapalPaymentController@payment']);
    Route::get('fees/pesapal/donepayment',           ['as' => 'fees.pesapal.paymentsuccess',            'middleware' => ['ability:super-admin,fees-payment-pesapal'],             'uses' => 'Fees\Payment\PesapalPaymentController@paymentsuccess']);
    Route::get('fees/pesapal/paymentconfirmation',   ['as' => 'fees.pesapal.paymentconfirmation',       'middleware' => ['ability:super-admin,fees-payment-pesapal'],             'uses' => 'Fees\Payment\PesapalPaymentController@paymentconfirmation']);

    /*Payroll Group*/
    /*Balance Payroll*/
    Route::get('payroll/balance',                    ['as' => 'payroll.balance',           'middleware' => ['ability:super-admin,payroll-index'],                   'uses' => 'Payroll\PayrollBaseController@index']);

    /*Payroll Head*/
    Route::get('payroll/head',                    ['as' => 'payroll.head',                  'middleware' => ['ability:super-admin,payroll-head-index'],             'uses' => 'Payroll\PayrollHeadController@index']);
    Route::post('payroll/head/store',             ['as' => 'payroll.head.store',            'middleware' => ['ability:super-admin,payroll-head-add'],               'uses' => 'Payroll\PayrollHeadController@store']);
    Route::get('payroll/head/{id}/edit',          ['as' => 'payroll.head.edit',             'middleware' => ['ability:super-admin,payroll-head-edit'],              'uses' => 'Payroll\PayrollHeadController@edit']);
    Route::post('payroll/head/{id}/update',       ['as' => 'payroll.head.update',           'middleware' => ['ability:super-admin,payroll-head-edit'],              'uses' => 'Payroll\PayrollHeadController@update']);
    Route::get('payroll/head/{id}/delete',        ['as' => 'payroll.head.delete',           'middleware' => ['ability:super-admin,payroll-head-delete'],            'uses' => 'Payroll\PayrollHeadController@delete']);
    Route::get('payroll/head/{id}/active',        ['as' => 'payroll.head.active',           'middleware' => ['ability:super-admin,payroll-head-active'],            'uses' => 'Payroll\PayrollHeadController@Active']);
    Route::get('payroll/head/{id}/in-active',     ['as' => 'payroll.head.in-active',        'middleware' => ['ability:super-admin,payroll-head-in-active'],         'uses' => 'Payroll\PayrollHeadController@inActive']);
    Route::post('payroll/head/bulk-action',       ['as' => 'payroll.head.bulk-action',      'middleware' => ['ability:super-admin,payroll-head-bulk-action'],       'uses' => 'Payroll\PayrollHeadController@bulkAction']);

    /*Payroll Master*/
    Route::get('payroll/master',                    ['as' => 'payroll.master',                  'middleware' => ['ability:super-admin,payroll-master-index'],           'uses' => 'Payroll\PayrollMasterController@index']);
    Route::get('payroll/master/add',                ['as' => 'payroll.master.add',              'middleware' => ['ability:super-admin,payroll-master-add'],             'uses' => 'Payroll\PayrollMasterController@add']);
    Route::post('payroll/master/store',             ['as' => 'payroll.master.store',            'middleware' => ['ability:super-admin,payroll-master-add'],             'uses' => 'Payroll\PayrollMasterController@store']);
    Route::get('payroll/master/{id}/edit',          ['as' => 'payroll.master.edit',             'middleware' => ['ability:super-admin,payroll-master-edit'],            'uses' => 'Payroll\PayrollMasterController@edit']);
    Route::post('payroll/master/{id}/update',       ['as' => 'payroll.master.update',           'middleware' => ['ability:super-admin,payroll-master-edit'],            'uses' => 'Payroll\PayrollMasterController@update']);
    Route::get('payroll/master/{id}/delete',        ['as' => 'payroll.master.delete',           'middleware' => ['ability:super-admin,payroll-master-delete'],          'uses' => 'Payroll\PayrollMasterController@delete']);
    Route::post('payroll/master/bulk-action',       ['as' => 'payroll.master.bulk-action',      'middleware' => ['ability:super-admin,payroll-master-bulk-action'],     'uses' => 'Payroll\PayrollMasterController@bulkAction']);
    Route::get('payroll/master/{id}/active',        ['as' => 'payroll.master.active',           'middleware' => ['ability:super-admin,payroll-master-active'],          'uses' => 'Payroll\PayrollMasterController@Active']);
    Route::get('payroll/master/{id}/in-active',     ['as' => 'payroll.master.in-active',        'middleware' => ['ability:super-admin,payroll-master-in-active'],       'uses' => 'Payroll\PayrollMasterController@inActive']);
    Route::post('payroll/master/payroll-html',       ['as' => 'payroll.master.payroll-html',                                                                            'uses' => 'Payroll\PayrollMasterController@payrollHtmlRow']);

    /*Pay Salary*/
    Route::get('salary/payment',                    ['as' => 'salary.payment',                  'middleware' => ['ability:super-admin,salary-payment-index'],           'uses' => 'Payroll\SalaryPayController@index']);
    Route::get('salary/payment/{id}/add',           ['as' => 'salary.payment.add',              'middleware' => ['ability:super-admin,salary-payment-add'],             'uses' => 'Payroll\SalaryPayController@add']);
    Route::post('salary/payment/store',             ['as' => 'salary.payment.store',            'middleware' => ['ability:super-admin,salary-payment-add'],             'uses' => 'Payroll\SalaryPayController@store']);
    Route::get('salary/payment/{id}/view',          ['as' => 'salary.payment.view',             'middleware' => ['ability:super-admin,salary-payment-view'],            'uses' => 'Payroll\SalaryPayController@view']);
    Route::get('salary/payment/{id}/delete',        ['as' => 'salary.payment.delete',           'middleware' => ['ability:super-admin,salary-payment-delete'],          'uses' => 'Payroll\SalaryPayController@delete']);

    /*Transaction Head*/
    Route::get('transaction-head',                    ['as' => 'transaction-head',                  'middleware' => ['ability:super-admin,transaction-head-index'],         'uses' => 'Transaction\TransactionHeadController@index']);
    Route::post('transaction-head/store',             ['as' => 'transaction-head.store',            'middleware' => ['ability:super-admin,transaction-head-add'],           'uses' => 'Transaction\TransactionHeadController@store']);
    Route::get('transaction-head/{id}/edit',          ['as' => 'transaction-head.edit',             'middleware' => ['ability:super-admin,transaction-head-edit'],          'uses' => 'Transaction\TransactionHeadController@edit']);
    Route::post('transaction-head/{id}/update',       ['as' => 'transaction-head.update',           'middleware' => ['ability:super-admin,transaction-head-edit'],          'uses' => 'Transaction\TransactionHeadController@update']);
    Route::get('transaction-head/{id}/delete',        ['as' => 'transaction-head.delete',           'middleware' => ['ability:super-admin,transaction-head-delete'],        'uses' => 'Transaction\TransactionHeadController@delete']);
    Route::get('transaction-head/{id}/active',        ['as' => 'transaction-head.active',           'middleware' => ['ability:super-admin,transaction-head-active'],        'uses' => 'Transaction\TransactionHeadController@Active']);
    Route::get('transaction-head/{id}/in-active',     ['as' => 'transaction-head.in-active',        'middleware' => ['ability:super-admin,transaction-head-in-active'],     'uses' => 'Transaction\TransactionHeadController@inActive']);
    Route::post('transaction-head/bulk-action',       ['as' => 'transaction-head.bulk-action',      'middleware' => ['ability:super-admin,transaction-head-bulk-action'],   'uses' => 'Transaction\TransactionHeadController@bulkAction']);

    /*Transaction*/
    Route::get('transaction',                    ['as' => 'transaction',                  'middleware' => ['ability:super-admin,transaction-index'],                'uses' => 'Transaction\TransactionController@index']);
    Route::get('transaction/add',                ['as' => 'transaction.add',              'middleware' => ['ability:super-admin,transaction-add'],                  'uses' => 'Transaction\TransactionController@add']);
    Route::post('transaction/store',             ['as' => 'transaction.store',            'middleware' => ['ability:super-admin,transaction-add'],                  'uses' => 'Transaction\TransactionController@store']);
    Route::get('transaction/{id}/edit',          ['as' => 'transaction.edit',             'middleware' => ['ability:super-admin,transaction-edit'],                 'uses' => 'Transaction\TransactionController@edit']);
    Route::post('transaction/{id}/update',       ['as' => 'transaction.update',           'middleware' => ['ability:super-admin,transaction-edit'],                 'uses' => 'Transaction\TransactionController@update']);
    Route::get('transaction/{id}/delete',        ['as' => 'transaction.delete',           'middleware' => ['ability:super-admin,transaction-delete'],               'uses' => 'Transaction\TransactionController@delete']);
    Route::post('transaction/bulk-action',       ['as' => 'transaction.bulk-action',      'middleware' => ['ability:super-admin,transaction-bulk-action'],          'uses' => 'Transaction\TransactionController@bulkAction']);
    Route::get('transaction/{id}/active',        ['as' => 'transaction.active',           'middleware' => ['ability:super-admin,transaction-active'],               'uses' => 'Transaction\TransactionController@Active']);
    Route::get('transaction/{id}/in-active',     ['as' => 'transaction.in-active',        'middleware' => ['ability:super-admin,transaction-in-active'],            'uses' => 'Transaction\TransactionController@inActive']);
    Route::post('transaction/tr-html',           ['as' => 'transaction.tr-html',                                                                                    'uses' => 'Transaction\TransactionController@trHtmlRow']);

});

/*Library Grouping*/
Route::group(['prefix' => 'library/',                                   'as' => 'library.',                                    'namespace' => 'Library\\'], function () {

    Route::get('',                          ['as' => '',                        'middleware' => ['ability:super-admin,library-index'],           'uses' => 'LibraryBaseController@index']);
    Route::post('issue',                    ['as' => 'issue',                   'middleware' => ['ability:super-admin,library-book-issue'],      'uses' => 'LibraryBaseController@issueBook']);
    Route::get('{id}/return',               ['as' => 'return',                  'middleware' => ['ability:super-admin,library-book-return'],     'uses' => 'LibraryBaseController@returnBook']);
    Route::get('return-over',               ['as' => 'return-over',             'middleware' => ['ability:super-admin,library-return-over'],     'uses' => 'LibraryBaseController@returnOver']);
    Route::get('issue-history',             ['as' => 'issue-history',           'middleware' => ['ability:super-admin,library-issue-history'],   'uses' => 'LibraryBaseController@issueHistory']);
    Route::post('book-detail-html',         ['as' => 'book-detail-html',                                                                         'uses' => 'LibraryBaseController@bookDetail']);
    Route::get('book-name-autocomplete',    ['as' => 'book-name-autocomplete',                                                                   'uses' => 'LibraryBaseController@bookNameAutocomplete']);

    /*Book Master*/
    Route::get('book',                          ['as' => 'book',                'middleware' => ['ability:super-admin,book-index'],         'uses' => 'BookController@index']);
    Route::get('book/add',                      ['as' => 'book.add',            'middleware' => ['ability:super-admin,book-add'],           'uses' => 'BookController@add']);
    Route::post('book/store',                   ['as' => 'book.store',          'middleware' => ['ability:super-admin,book-add'],           'uses' => 'BookController@store']);
    Route::get('book/{id}/edit',                ['as' => 'book.edit',           'middleware' => ['ability:super-admin,book-edit'],          'uses' => 'BookController@edit']);
    Route::post('book/{id}/update',             ['as' => 'book.update',         'middleware' => ['ability:super-admin,book-edit'],          'uses' => 'BookController@update']);

    Route::get('book/import',                      ['as' => 'book.import',            'middleware' => ['ability:super-admin,book-add'],           'uses' => 'BookController@importBook']);
    Route::post('book/import',                     ['as' => 'book.bulk.import',        'middleware' => ['ability:super-admin,book-add'],             'uses' => 'BookController@handleImportBook']);


    Route::get('book/{id}/view',                ['as' => 'book.view',           'middleware' => ['ability:super-admin,book-view'],          'uses' => 'BookController@view']);
    Route::get('book/{id}/delete',              ['as' => 'book.delete',         'middleware' => ['ability:super-admin,book-delete'],        'uses' => 'BookController@delete']);
    Route::get('book/{id}/active',              ['as' => 'book.active',         'middleware' => ['ability:super-admin,book-active'],        'uses' => 'BookController@Active']);
    Route::get('book/{id}/in-active',           ['as' => 'book.in-active',      'middleware' => ['ability:super-admin,book-in-active'],     'uses' => 'BookController@inActive']);
    Route::post('book/bulk-action',             ['as' => 'book.bulk-action',    'middleware' => ['ability:super-admin,book-bulk-action'],   'uses' => 'BookController@bulkAction']);

    /*Book Level*/
    Route::post('book/add/copies',                  ['as' => 'book.add.copies',             'middleware' => ['ability:super-admin,book-add-copies'],              'uses' => 'BookController@addCopies']);
    Route::get('book/{id}/book-status/{status}',    ['as' => 'book.book-status',            'middleware' => ['ability:super-admin,book-status'],                  'uses' => 'BookController@bookStatus']);
    Route::post('book/bulk-copies-delete',          ['as' => 'book.bulk-copies-delete',     'middleware' => ['ability:super-admin,book-bulk-copies-delete'],      'uses' => 'BookController@bulkCopiesDelete']);

    /*Books Category Routes*/
    Route::get('book/category',                     ['as' => 'book.category',               'middleware' => ['ability:super-admin,book-category-index'],            'uses' => 'BookCategoryController@index']);
    Route::post('book/category/store',              ['as' => 'book.category.store',         'middleware' => ['ability:super-admin,book-category-add'],              'uses' => 'BookCategoryController@store']);
    Route::get('book/category/{id}/edit',           ['as' => 'book.category.edit',          'middleware' => ['ability:super-admin,book-category-edit'],             'uses' => 'BookCategoryController@edit']);
    Route::post('book/category/{id}/update',        ['as' => 'book.category.update',        'middleware' => ['ability:super-admin,book-category-edit'],             'uses' => 'BookCategoryController@update']);
    Route::get('book/category/{id}/delete',         ['as' => 'book.category.delete',        'middleware' => ['ability:super-admin,book-category-delete'],           'uses' => 'BookCategoryController@delete']);
    Route::get('book/category/{id}/active',         ['as' => 'book.category.active',        'middleware' => ['ability:super-admin,book-category-active'],           'uses' => 'BookCategoryController@Active']);
    Route::get('book/category/{id}/in-active',      ['as' => 'book.category.in-active',     'middleware' => ['ability:super-admin,book-category-in-active'],        'uses' => 'BookCategoryController@inActive']);
    Route::post('book/category/bulk-action',        ['as' => 'book.category.bulk-action',   'middleware' => ['ability:super-admin,book-category-bulk-action'],      'uses' => 'BookCategoryController@bulkAction']);

    /*Books Category Routes*/
    Route::get('circulation',                       ['as' => 'circulation',                 'middleware' => ['ability:super-admin,library-circulation-index'],          'uses' => 'CirculationController@index']);
    Route::post('circulation/store',                ['as' => 'circulation.store',           'middleware' => ['ability:super-admin,library-circulation-add'],            'uses' => 'CirculationController@store']);
    Route::get('circulation/{id}/edit',             ['as' => 'circulation.edit',            'middleware' => ['ability:super-admin,library-circulation-edit'],           'uses' => 'CirculationController@edit']);
    Route::post('circulation/{id}/update',          ['as' => 'circulation.update',          'middleware' => ['ability:super-admin,library-circulation-edit'],           'uses' => 'CirculationController@update']);
    Route::get('circulation/{id}/delete',           ['as' => 'circulation.delete',          'middleware' => ['ability:super-admin,library-circulation-delete'],         'uses' => 'CirculationController@delete']);
    Route::get('circulation/{id}/active',           ['as' => 'circulation.active',          'middleware' => ['ability:super-admin,library-circulation-active'],         'uses' => 'CirculationController@Active']);
    Route::get('circulation/{id}/in-active',        ['as' => 'circulation.in-active',       'middleware' => ['ability:super-admin,library-circulation-in-active'],      'uses' => 'CirculationController@inActive']);
    Route::post('circulation/bulk-action',          ['as' => 'circulation.bulk-action',     'middleware' => ['ability:super-admin,library-circulation-bulk-action'],    'uses' => 'CirculationController@bulkAction']);

    /*Library Member Routes*/
    Route::get('member',                    ['as' => 'member',              'middleware' => ['ability:super-admin,library-member-index'],           'uses' => 'MemberController@index']);
    Route::get('member/add',                ['as' => 'member.add',          'middleware' => ['ability:super-admin,library-member-add'],             'uses' => 'MemberController@add']);
    Route::post('member/store',             ['as' => 'member.store',        'middleware' => ['ability:super-admin,library-member-add'],             'uses' => 'MemberController@store']);
    Route::get('member/{id}/edit',          ['as' => 'member.edit',         'middleware' => ['ability:super-admin,library-member-edit'],            'uses' => 'MemberController@edit']);
    Route::post('member/{id}/update',       ['as' => 'member.update',       'middleware' => ['ability:super-admin,library-member-edit'],            'uses' => 'MemberController@update']);
    Route::get('member/{id}/delete',        ['as' => 'member.delete',       'middleware' => ['ability:super-admin,library-member-delete'],          'uses' => 'MemberController@delete']);
    Route::get('member/{id}/active',        ['as' => 'member.active',       'middleware' => ['ability:super-admin,library-member-active'],          'uses' => 'MemberController@Active']);
    Route::get('member/{id}/in-active',     ['as' => 'member.in-active',    'middleware' => ['ability:super-admin,library-member-in-active'],       'uses' => 'MemberController@inActive']);
    Route::post('member/bulk-action',       ['as' => 'member.bulk-action',  'middleware' => ['ability:super-admin,library-member-bulk-action'],     'uses' => 'MemberController@bulkAction']);

    /*Library Member Staff Routes*/
    /*Staff Member*/
    Route::get('staff',                 ['as' => 'staff',                   'middleware' => ['ability:super-admin,library-member-staff'],      'uses' => 'StaffMemberController@staff']);
    Route::get('staff/{id}/view',       ['as' => 'staff.view',              'middleware' => ['ability:super-admin,library-member-staff-view'],      'uses' => 'StaffMemberController@staffView']);

    /*Student Member*/
    Route::get('student',                   ['as' => 'student',                 'middleware' => ['ability:super-admin,library-member-student'],      'uses' => 'StudentMemberController@student']);
    Route::get('student/{id}/view',         ['as' => 'student.view',            'middleware' => ['ability:super-admin,library-member-student-view'],      'uses' => 'StudentMemberController@studentView']);

});

/*Attendance Grouping*/
Route::group(['prefix' => 'attendance/',                                'as' => 'attendance',                                  'namespace' => 'Attendance\\'], function () {
 /*Attendance */
    /*Attendance Master*/
    Route::get('master',                        ['as' => '.master',                 'middleware' => ['ability:super-admin,attendance-master-index'],            'uses' => 'AttendanceMasterController@index']);
    Route::get('master/add',                    ['as' => '.master.add',             'middleware' => ['ability:super-admin,attendance-master-add'],              'uses' => 'AttendanceMasterController@add']);
    Route::post('master/store',                 ['as' => '.master.store',           'middleware' => ['ability:super-admin,attendance-master-add'],              'uses' => 'AttendanceMasterController@store']);
    Route::get('master/{id}/edit',              ['as' => '.master.edit',            'middleware' => ['ability:super-admin,attendance-master-edit'],             'uses' => 'AttendanceMasterController@edit']);
    Route::post('master/{id}/update',           ['as' => '.master.update',          'middleware' => ['ability:super-admin,attendance-master-edit'],             'uses' => 'AttendanceMasterController@update']);
    Route::get('master/{id}/delete',            ['as' => '.master.delete',          'middleware' => ['ability:super-admin,attendance-master-delete'],           'uses' => 'AttendanceMasterController@delete']);
    Route::get('master/{id}/active',            ['as' => '.master.active',          'middleware' => ['ability:super-admin,attendance-master-active'],           'uses' => 'AttendanceMasterController@Active']);
    Route::get('master/{id}/in-active',         ['as' => '.master.in-active',       'middleware' => ['ability:super-admin,attendance-master-in-active'],        'uses' => 'AttendanceMasterController@inActive']);
    Route::post('master/bulk-action',           ['as' => '.master.bulk-action',     'middleware' => ['ability:super-admin,attendance-master-bulk-action'],      'uses' => 'AttendanceMasterController@bulkAction']);
    Route::post('master/month-html',            ['as' => '.master.month-html',                                                                                  'uses' => 'AttendanceMasterController@monthHtmlRow']);

    /*Student Attendance*/
    Route::get('student',                   ['as' => '.student',                    'middleware' => ['ability:super-admin,student-attendance-index'],           'uses' => 'StudentAttendanceController@index']);
    Route::get('student/add',               ['as' => '.student.add',                'middleware' => ['ability:super-admin,student-attendance-add'],             'uses' => 'StudentAttendanceController@add']);
    Route::post('student/store',            ['as' => '.student.store',              'middleware' => ['ability:super-admin,student-attendance-add'],             'uses' => 'StudentAttendanceController@store']);
    Route::get('student/{id}/delete',       ['as' => '.student.delete',             'middleware' => ['ability:super-admin,student-attendance-delete'],          'uses' => 'StudentAttendanceController@delete']);
    Route::post('student/bulk-action',      ['as' => '.student.bulk-action',        'middleware' => ['ability:super-admin,student-attendance-bulk-action'],     'uses' => 'StudentAttendanceController@bulkAction']);
    Route::post('student-html',             ['as' => '.student-html',                                                                                           'uses' => 'StudentAttendanceController@studentHtmlRow']);

    /*Staff Attendance*/
    Route::get('staff',                         ['as' => '.staff',                  'middleware' => ['ability:super-admin,staff-attendance-index'],             'uses' => 'StaffAttendanceController@index']);
    Route::get('staff/add',                     ['as' => '.staff.add',              'middleware' => ['ability:super-admin,staff-attendance-add'],               'uses' => 'StaffAttendanceController@add']);
    Route::post('staff/store',                  ['as' => '.staff.store',            'middleware' => ['ability:super-admin,staff-attendance-add'],               'uses' => 'StaffAttendanceController@store']);
    Route::get('staff/{id}/delete',             ['as' => '.staff.delete',           'middleware' => ['ability:super-admin,staff-attendance-delete'],            'uses' => 'StaffAttendanceController@delete']);
    Route::post('staff/bulk-action',            ['as' => '.staff.bulk-action',      'middleware' => ['ability:super-admin,staff-attendance-bulk-action'],       'uses' => 'StaffAttendanceController@bulkAction']);
    Route::post('staff-html',                   ['as' => '.staff-html',                                                                                         'uses' => 'StaffAttendanceController@staffHtmlRow']);
});

/*Exam group */
Route::group(['prefix' => 'exam/',                                      'as' => 'exam',                                         'namespace' => 'Examination\\'], function () {

    /*Exam Types Routes*/
    Route::get('',                                  ['as' => '',                  'middleware' => ['ability:super-admin,exam-index'],           'uses' => 'ExamController@index']);
    Route::post('store',                            ['as' => '.store',            'middleware' => ['ability:super-admin,exam-add'],             'uses' => 'ExamController@store']);
    Route::get('{id}/edit',                         ['as' => '.edit',             'middleware' => ['ability:super-admin,exam-edit'],            'uses' => 'ExamController@edit']);
    Route::post('{id}/update',                      ['as' => '.update',           'middleware' => ['ability:super-admin,exam-edit'],            'uses' => 'ExamController@update']);
    Route::get('{id}/delete',                       ['as' => '.delete',           'middleware' => ['ability:super-admin,exam-delete'],          'uses' => 'ExamController@delete']);
    Route::get('{id}/active',                       ['as' => '.active',           'middleware' => ['ability:super-admin,exam-active'],          'uses' => 'ExamController@Active']);
    Route::get('{id}/in-active',                    ['as' => '.in-active',        'middleware' => ['ability:super-admin,exam-in-active'],       'uses' => 'ExamController@inActive']);
    Route::post('bulk-action',                      ['as' => '.bulk-action',      'middleware' => ['ability:super-admin,exam-bulk-action'],     'uses' => 'ExamController@bulkAction']);

    /*Exam AdmitCard Routes*/
    Route::get('admit-card',                        ['as' => '.admit-card',         'middleware' => ['ability:super-admin,exam-admit-card'],        'uses' => 'ExamController@admitCard']);
    Route::get('routine',                           ['as' => '.routine',            'middleware' => ['ability:super-admin,exam-exam-routine'],      'uses' => 'ExamController@examRoutine']);
    Route::get('mark-sheet',                        ['as' => '.mark-sheet',         'middleware' => ['ability:super-admin,exam-mark-sheet'],        'uses' => 'ExamController@markSheet']);

    //result publish status
    Route::get('schedule/{year}/{month}/{exam}/{faculty}/{semester}/result-publish',    ['as' => '.schedule.result-publish',                  'middleware' => ['ability:super-admin,exam-result-publish'],                'uses' => 'ExamScheduleController@publish']);
    Route::get('schedule/{year}/{month}/{exam}/{faculty}/{semester}/result-un-publish', ['as' => '.schedule.result-un-publish',               'middleware' => ['ability:super-admin,exam-result-un-publish'],             'uses' => 'ExamScheduleController@unPublish']);

    /*Exam Schedule Routes*/
    Route::get('schedule',                                                      ['as' => '.schedule',                  'middleware' => ['ability:super-admin,exam-schedule-index'],                 'uses' => 'ExamScheduleController@index']);
    Route::get('schedule/add',                                                  ['as' => '.schedule.add',              'middleware' => ['ability:super-admin,exam-schedule-add'],                   'uses' => 'ExamScheduleController@add']);
    Route::post('schedule/store',                                               ['as' => '.schedule.store',            'middleware' => ['ability:super-admin,exam-schedule-add'],                   'uses' => 'ExamScheduleController@store']);
    Route::get('schedule/{id}/edit',                                            ['as' => '.schedule.edit',             'middleware' => ['ability:super-admin,exam-schedule-edit'],                  'uses' => 'ExamScheduleController@edit']);
    Route::post('schedule/{id}/update',                                         ['as' => '.schedule.update',           'middleware' => ['ability:super-admin,exam-schedule-edit'],                  'uses' => 'ExamScheduleController@update']);
    Route::get('schedule/{year}/{month}/{exam}/{faculty}/{semester}/delete',    ['as' => '.schedule.delete',           'middleware' => ['ability:super-admin,exam-schedule-delete'],                'uses' => 'ExamScheduleController@delete']);
    Route::get('schedule/{year}/{month}/{exam}/{faculty}/{semester}/active',    ['as' => '.schedule.active',           'middleware' => ['ability:super-admin,exam-schedule-active'],                'uses' => 'ExamScheduleController@active']);
    Route::get('schedule/{year}/{month}/{exam}/{faculty}/{semester}/in-active', ['as' => '.schedule.in-active',        'middleware' => ['ability:super-admin,exam-schedule-in-active'],             'uses' => 'ExamScheduleController@inActive']);
    Route::post('schedule/subject-html',                                        ['as' => '.schedule.subject-html',                                                                                  'uses' => 'ExamScheduleController@subjectHtmlRow']);



    /*Exam Schedule Routes*/
    Route::get('mark-ledger',                                                      ['as' => '.mark-ledger',                     'middleware' => ['ability:super-admin,exam-mark-ledger-index'],                 'uses' => 'ExamMarkLedgerController@index']);
    Route::get('mark-ledger/add',                                                  ['as' => '.mark-ledger.add',                 'middleware' => ['ability:super-admin,exam-mark-ledger-add'],                   'uses' => 'ExamMarkLedgerController@add']);
    Route::post('mark-ledger/store',                                               ['as' => '.mark-ledger.store',               'middleware' => ['ability:super-admin,exam-mark-ledger-add'],                   'uses' => 'ExamMarkLedgerController@store']);
    Route::get('mark-ledger/{id}/edit',                                            ['as' => '.mark-ledger.edit',                'middleware' => ['ability:super-admin,exam-mark-ledger-edit'],                  'uses' => 'ExamMarkLedgerController@edit']);
    Route::post('mark-ledger/{id}/update',                                         ['as' => '.mark-ledger.update',              'middleware' => ['ability:super-admin,exam-mark-ledger-edit'],                  'uses' => 'ExamMarkLedgerController@update']);
    Route::get('mark-ledger/{exam}/{student}/delete',                              ['as' => '.mark-ledger.delete',              'middleware' => ['ability:super-admin,exam-mark-ledger-delete'],                'uses' => 'ExamMarkLedgerController@delete']);
    Route::get('mark-ledger/{exam}/{student}/active',                              ['as' => '.mark-ledger.active',              'middleware' => ['ability:super-admin,exam-mark-ledger-active'],                'uses' => 'ExamMarkLedgerController@active']);
    Route::get('mark-ledger/{exam}/{student}/in-active',                           ['as' => '.mark-ledger.in-active',           'middleware' => ['ability:super-admin,exam-mark-ledger-in-acctive'],            'uses' => 'ExamMarkLedgerController@inActive']);
    Route::post('mark-ledger/find-subject',                                        ['as' => '.mark-ledger.find-subject',                                                                                        'uses' => 'ExamMarkLedgerController@findSubject']);
    Route::post('mark-ledger/student-html',                                        ['as' => '.mark-ledger.student-html',                                                                                        'uses' => 'ExamMarkLedgerController@studentHtmlRow']);

});

/*Hostel Grouping */
Route::group(['prefix' => 'hostel/',                                    'as' => 'hostel',                                       'namespace' => 'Hostel\\'], function () {

    /*Hostel Routes*/
    Route::get('',                   ['as' => '',                  'middleware' => ['ability:super-admin,hostel-index'],                'uses' => 'HostelController@index']);
    Route::get('add',                ['as' => '.add',              'middleware' => ['ability:super-admin,hostel-add'],                  'uses' => 'HostelController@add']);
    Route::post('store',             ['as' => '.store',            'middleware' => ['ability:super-admin,hostel-add'],                  'uses' => 'HostelController@store']);
    Route::get('{id}/edit',          ['as' => '.edit',             'middleware' => ['ability:super-admin,hostel-edit'],                 'uses' => 'HostelController@edit']);
    Route::post('{id}/update',       ['as' => '.update',           'middleware' => ['ability:super-admin,hostel-edit'],                 'uses' => 'HostelController@update']);
    Route::get('{id}/view',          ['as' => '.view',             'middleware' => ['ability:super-admin,hostel-view'],                 'uses' => 'HostelController@view']);
    Route::get('{id}/delete',        ['as' => '.delete',           'middleware' => ['ability:super-admin,hostel-delete'],               'uses' => 'HostelController@delete']);
    Route::get('{id}/active',        ['as' => '.active',           'middleware' => ['ability:super-admin,hostel-active'],               'uses' => 'HostelController@Active']);
    Route::get('{id}/in-active',     ['as' => '.in-active',        'middleware' => ['ability:super-admin,hostel-in-active'],            'uses' => 'HostelController@inActive']);
    Route::post('bulk-action',       ['as' => '.bulk-action',      'middleware' => ['ability:super-admin,hostel-bulk-action'],          'uses' => 'HostelController@bulkAction']);
    Route::post('find-rooms',        ['as' => '.find-rooms',                                                                            'uses' => 'HostelController@findRooms']);
    Route::post('find-beds',         ['as' => '.find-beds',                                                                              'uses' => 'HostelController@findBeds']);

    /*Rooms Level*/
    Route::post('room/add',                         ['as' => '.room.add',                   'middleware' => ['ability:super-admin,room-add'],               'uses' => 'RoomController@add']);
    Route::get('room/{id}/view',                    ['as' => '.room.view',                  'middleware' => ['ability:super-admin,room-view'],              'uses' => 'RoomController@view']);
    Route::post('room/{id}/update',                 ['as' => '.room.update',                'middleware' => ['ability:super-admin,room-edit'],              'uses' => 'RoomController@update']);
    Route::get('room/{id}/delete',                  ['as' => '.room.delete',                'middleware' => ['ability:super-admin,room-delete'],            'uses' => 'RoomController@delete']);
    Route::get('room/{id}/active',                  ['as' => '.room.active',                'middleware' => ['ability:super-admin,room-active'],            'uses' => 'RoomController@Active']);
    Route::get('room/{id}/in-active',               ['as' => '.room.in-active',             'middleware' => ['ability:super-admin,room-in-active'],         'uses' => 'RoomController@InActive']);
    Route::post('room/bulk-rooms',                  ['as' => '.room.bulk-rooms',            'middleware' => ['ability:super-admin,room-bulk-action'],       'uses' => 'RoomController@bulkAction']);

    /*Bed*/
    Route::post('bed/add',                          ['as' => '.bed.add',                'middleware' => ['ability:super-admin,bed-add'],                'uses' => 'BedController@addBeds']);
    Route::get('bed/{id}/bed-status/{status}',      ['as' => '.bed.bed-status',         'middleware' => ['ability:super-admin,bed-status'],             'uses' => 'BedController@bedStatus']);
    Route::get('bed/{id}/delete',                   ['as' => '.bed.delete',             'middleware' => ['ability:super-admin,bed-delete'],             'uses' => 'BedController@delete']);
    Route::get('bed/{id}/active',                   ['as' => '.bed.active',             'middleware' => ['ability:super-admin,bed-active'],             'uses' => 'BedController@Active']);
    Route::get('bed/{id}/in-active',                ['as' => '.bed.in-active',          'middleware' => ['ability:super-admin,bed-in-active'],          'uses' => 'BedController@InActive']);
    Route::post('bed/bulk-beds',                    ['as' => '.bed.bulk-beds',          'middleware' => ['ability:super-admin,bed-bulk-action'],        'uses' => 'BedController@bulkAction']);

    /*Room Types Routes*/
    Route::get('room-type',                    ['as' => '.room-type',                  'middleware' => ['ability:super-admin,room-type-index'],             'uses' => 'RoomTypeController@index']);
    Route::post('room-type/store',             ['as' => '.room-type.store',            'middleware' => ['ability:super-admin,room-type-add'],               'uses' => 'RoomTypeController@store']);
    Route::get('room-type/{id}/edit',          ['as' => '.room-type.edit',             'middleware' => ['ability:super-admin,room-type-edit'],              'uses' => 'RoomTypeController@edit']);
    Route::post('room-type/{id}/update',       ['as' => '.room-type.update',           'middleware' => ['ability:super-admin,room-type-edit'],              'uses' => 'RoomTypeController@update']);
    Route::get('room-type/{id}/delete',        ['as' => '.room-type.delete',           'middleware' => ['ability:super-admin,room-type-delete'],            'uses' => 'RoomTypeController@delete']);
    Route::get('room-type/{id}/active',        ['as' => '.room-type.active',           'middleware' => ['ability:super-admin,room-type-active'],            'uses' => 'RoomTypeController@Active']);
    Route::get('room-type/{id}/in-active',     ['as' => '.room-type.in-active',        'middleware' => ['ability:super-admin,room-type-in-active'],         'uses' => 'RoomTypeController@inActive']);
    Route::post('room-type/bulk-action',       ['as' => '.room-type.bulk-action',      'middleware' => ['ability:super-admin,room-type-bulk-action'],       'uses' => 'RoomTypeController@bulkAction']);

    /*Hostel Resident Routes*/
    Route::get('resident',                    ['as' => '.resident',                     'middleware' => ['ability:super-admin,resident-index'],                'uses' => 'ResidentController@index']);
    Route::get('resident/add',                ['as' => '.resident.add',                 'middleware' => ['ability:super-admin,resident-add'],                  'uses' => 'ResidentController@add']);
    Route::post('resident/store',             ['as' => '.resident.store',               'middleware' => ['ability:super-admin,resident-add'],                  'uses' => 'ResidentController@store']);
    Route::get('resident/{id}/edit',          ['as' => '.resident.edit',                'middleware' => ['ability:super-admin,resident-edit'],                 'uses' => 'ResidentController@edit']);
    Route::post('resident/{id}/update',       ['as' => '.resident.update',              'middleware' => ['ability:super-admin,resident-edit'],                 'uses' => 'ResidentController@update']);
    Route::get('resident/{id}/delete',        ['as' => '.resident.delete',              'middleware' => ['ability:super-admin,resident-delete'],               'uses' => 'ResidentController@delete']);
    Route::post('resident/bulk-action',       ['as' => '.resident.bulk-action',         'middleware' => ['ability:super-admin,resident-bulk-action'],          'uses' => 'ResidentController@bulkAction']);
    Route::post('resident/renew',             ['as' => '.resident.renew',               'middleware' => ['ability:super-admin,resident-renew'],                 'uses' => 'ResidentController@renew']);
    Route::get('resident/{id}/leave',         ['as' => '.resident.leave',               'middleware' => ['ability:super-admin,resident-leave'],                 'uses' => 'ResidentController@leave']);
    Route::post('resident/shift',             ['as' => '.resident.shift',               'middleware' => ['ability:super-admin,resident-shift'],                 'uses' => 'ResidentController@shift']);
    Route::get('resident/history',            ['as' => '.resident.history',             'middleware' => ['ability:super-admin,resident-history'],               'uses' => 'ResidentController@history']);
    /*For Search and Listing Room & Bed*/
    Route::post('resident/find-rooms',        ['as' => '.resident.find-rooms',          'middleware' => ['ability:super-admin,resident'],                       'uses' => 'ResidentController@findRooms']);
    Route::post('resident/find-beds',         ['as' => '.resident.find-beds',           'middleware' => ['ability:super-admin,resident'],                       'uses' => 'ResidentController@findBeds']);

/*Food & Meal*/
    /*Food Schedule Routes*/
    Route::get('food',                          ['as' => '.food',                       'middleware' => ['ability:super-admin,food-index'],                 'uses' => 'FoodController@index']);
    Route::post('food/store',                   ['as' => '.food.store',                 'middleware' => ['ability:super-admin,food-add'],                   'uses' => 'FoodController@store']);
    Route::get('food/{id}/edit',                ['as' => '.food.edit',                  'middleware' => ['ability:super-admin,food-edit'],                  'uses' => 'FoodController@edit']);
    Route::post('food/{id}/update',             ['as' => '.food.update',                'middleware' => ['ability:super-admin,food-edit'],                  'uses' => 'FoodController@update']);
    Route::get('food/{id}/delete',              ['as' => '.food.delete',                'middleware' => ['ability:super-admin,food-delete'],                'uses' => 'FoodController@delete']);
    Route::get('food/{id}/active',              ['as' => '.food.active',                'middleware' => ['ability:super-admin,food-active'],                'uses' => 'FoodController@Active']);
    Route::get('food/{id}/in-active',           ['as' => '.food.in-active',             'middleware' => ['ability:super-admin,food-in-active'],             'uses' => 'FoodController@inActive']);
    Route::post('food/bulk-action',             ['as' => '.food.bulk-action',           'middleware' => ['ability:super-admin,food-bulk-action'],           'uses' => 'FoodController@bulkAction']);
    Route::post('food/food-html',               ['as' => '.food.food-html',                                                                                 'uses' => 'FoodController@foodHtmlRow']);
    Route::get('food-name-autocomplete',        ['as' => '.food-name-autocomplete',                                                                         'uses' => 'FoodController@foodNameAutocomplete']);

    /*Food Category Routes*/
    Route::get('food/category',                    ['as' => '.food.category',                  'middleware' => ['ability:super-admin,food-category-index'],             'uses' => 'FoodCategoryController@index']);
    Route::post('food/category/store',             ['as' => '.food.category.store',            'middleware' => ['ability:super-admin,food-category-add'],               'uses' => 'FoodCategoryController@store']);
    Route::get('food/category/{id}/edit',          ['as' => '.food.category.edit',             'middleware' => ['ability:super-admin,food-category-edit'],              'uses' => 'FoodCategoryController@edit']);
    Route::post('food/category/{id}/update',       ['as' => '.food.category.update',           'middleware' => ['ability:super-admin,food-category-edit'],              'uses' => 'FoodCategoryController@update']);
    Route::get('food/category/{id}/delete',        ['as' => '.food.category.delete',           'middleware' => ['ability:super-admin,food-category-delete'],            'uses' => 'FoodCategoryController@delete']);
    Route::get('food/category/{id}/active',        ['as' => '.food.category.active',           'middleware' => ['ability:super-admin,food-category-active'],            'uses' => 'FoodCategoryController@Active']);
    Route::get('food/category/{id}/in-active',     ['as' => '.food.category.in-active',        'middleware' => ['ability:super-admin,food-category-in-active'],         'uses' => 'FoodCategoryController@inActive']);
    Route::post('food/category/bulk-action',       ['as' => '.food.category.bulk-action',      'middleware' => ['ability:super-admin,food-category-bulk-action'],       'uses' => 'FoodCategoryController@bulkAction']);

    /*Food Item Routes*/
    Route::get('food/item',                    ['as' => '.food.item',                          'middleware' => ['ability:super-admin,food-item-index'],             'uses' => 'FoodItemController@index']);
    Route::post('food/item/store',             ['as' => '.food.item.store',                    'middleware' => ['ability:super-admin,food-item-add'],               'uses' => 'FoodItemController@store']);
    Route::get('food/item/{id}/edit',          ['as' => '.food.item.edit',                     'middleware' => ['ability:super-admin,food-item-edit'],              'uses' => 'FoodItemController@edit']);
    Route::post('food/item/{id}/update',       ['as' => '.food.item.update',                   'middleware' => ['ability:super-admin,food-item-edit'],              'uses' => 'FoodItemController@update']);
    Route::get('food/item/{id}/delete',        ['as' => '.food.item.delete',                   'middleware' => ['ability:super-admin,food-item-delete'],            'uses' => 'FoodItemController@delete']);
    Route::get('food/item/{id}/active',        ['as' => '.food.item.active',                   'middleware' => ['ability:super-admin,food-item-active'],            'uses' => 'FoodItemController@Active']);
    Route::get('food/item/{id}/in-active',     ['as' => '.food.item.in-active',                'middleware' => ['ability:super-admin,food-item-in-active'],         'uses' => 'FoodItemController@inActive']);
    Route::post('food/item/bulk-action',       ['as' => '.food.item.bulk-action',              'middleware' => ['ability:super-admin,food-item-bulk-action'],       'uses' => 'FoodItemController@bulkAction']);

    /*Food Eating Time Routes*/
    Route::get('food/eating-time',                    ['as' => '.food.eating-time',                  'middleware' => ['ability:super-admin,eating-time-index'],             'uses' => 'EatingTimeController@index']);
    Route::post('food/eating-time/store',             ['as' => '.food.eating-time.store',            'middleware' => ['ability:super-admin,eating-time-add'],               'uses' => 'EatingTimeController@store']);
    Route::get('food/eating-time/{id}/edit',          ['as' => '.food.eating-time.edit',             'middleware' => ['ability:super-admin,eating-time-edit'],              'uses' => 'EatingTimeController@edit']);
    Route::post('food/eating-time/{id}/update',       ['as' => '.food.eating-time.update',           'middleware' => ['ability:super-admin,eating-time-edit'],              'uses' => 'EatingTimeController@update']);
    Route::get('food/eating-time/{id}/delete',        ['as' => '.food.eating-time.delete',           'middleware' => ['ability:super-admin,eating-time-delete'],            'uses' => 'EatingTimeController@delete']);
    Route::get('food/eating-time/{id}/active',        ['as' => '.food.eating-time.active',           'middleware' => ['ability:super-admin,eating-time-active'],            'uses' => 'EatingTimeController@Active']);
    Route::get('food/eating-time/{id}/in-active',     ['as' => '.food.eating-time.in-active',        'middleware' => ['ability:super-admin,eating-time-in-acctive'],        'uses' => 'EatingTimeController@inActive']);
    Route::post('food/eating-time/bulk-action',       ['as' => '.food.eating-time.bulk-action',      'middleware' => ['ability:super-admin,eating-time-bulk-action'],       'uses' => 'EatingTimeController@bulkAction']);
});

/*Transport Grouping */
Route::group(['prefix' => 'transport/',                                 'as' => 'transport',                                    'namespace' => 'Transport\\'], function () {

    /*Room Types Routes*/
    Route::get('route',                         ['as' => '.route',                      'middleware' => ['ability:super-admin,transport-route-index'],              'uses' => 'RouteController@index']);
    Route::post('route/store',                  ['as' => '.route.store',                'middleware' => ['ability:super-admin,transport-route-add'],                'uses' => 'RouteController@store']);
    Route::get('route/{id}/edit',               ['as' => '.route.edit',                 'middleware' => ['ability:super-admin,transport-route-edit'],               'uses' => 'RouteController@edit']);
    Route::post('route/{id}/update',            ['as' => '.route.update',               'middleware' => ['ability:super-admin,transport-route-edit'],               'uses' => 'RouteController@update']);
    Route::get('route/{id}/delete',             ['as' => '.route.delete',               'middleware' => ['ability:super-admin,transport-route-delete'],             'uses' => 'RouteController@delete']);
    Route::get('route/{id}/active',             ['as' => '.route.active',               'middleware' => ['ability:super-admin,transport-route-active'],             'uses' => 'RouteController@Active']);
    Route::get('route/{id}/in-active',          ['as' => '.route.in-active',            'middleware' => ['ability:super-admin,transport-route-in-active'],          'uses' => 'RouteController@inActive']);
    Route::post('route/bulk-action',            ['as' => '.route.bulk-action',          'middleware' => ['ability:super-admin,transport-route-bulk-action'],        'uses' => 'RouteController@bulkAction']);
    Route::post('route/vehicle-html',           ['as' => '.route.vehicle-html',                                                                                     'uses' => 'RouteController@vehicleHtmlRow']);
    Route::get('vehicle-autocomplete',          ['as' => '.vehicle-autocomplete',                                                                                   'uses' => 'RouteController@vehicleAutocomplete']);

    /*Room Types Routes*/
    Route::get('vehicle',                       ['as' => '.vehicle',                    'middleware' => ['ability:super-admin,vehicle-index'],                  'uses' => 'VehicleController@index']);
    Route::post('vehicle/store',                ['as' => '.vehicle.store',              'middleware' => ['ability:super-admin,vehicle-add'],                    'uses' => 'VehicleController@store']);
    Route::get('vehicle/{id}/edit',             ['as' => '.vehicle.edit',               'middleware' => ['ability:super-admin,vehicle-edit'],                   'uses' => 'VehicleController@edit']);
    Route::post('vehicle/{id}/update',          ['as' => '.vehicle.update',             'middleware' => ['ability:super-admin,vehicle-edit'],                   'uses' => 'VehicleController@update']);
    Route::get('vehicle/{id}/delete',           ['as' => '.vehicle.delete',             'middleware' => ['ability:super-admin,vehicle-delete'],                 'uses' => 'VehicleController@delete']);
    Route::get('vehicle/{id}/active',           ['as' => '.vehicle.active',             'middleware' => ['ability:super-admin,vehicle-active'],                 'uses' => 'VehicleController@Active']);
    Route::get('vehicle/{id}/in-active',        ['as' => '.vehicle.in-active',          'middleware' => ['ability:super-admin,vehicle-in-active'],              'uses' => 'VehicleController@inActive']);
    Route::post('vehicle/bulk-action',          ['as' => '.vehicle.bulk-action',        'middleware' => ['ability:super-admin,vehicle-bulk-action'],            'uses' => 'VehicleController@bulkAction']);
    Route::post('vehicle/staff-html',           ['as' => '.vehicle.staff-html',                                                                                 'uses' => 'VehicleController@staffHtmlRow']);
    Route::get('staff-autocomplete',            ['as' => '.staff-autocomplete',                                                                                 'uses' => 'VehicleController@staffAutocomplete']);

    /*Travellers Routes*/
    Route::get('user',                    ['as' => '.user',                     'middleware' => ['ability:super-admin,transport-user-index'],                'uses' => 'TransportUserController@index']);
    Route::get('user/add',                ['as' => '.user.add',                 'middleware' => ['ability:super-admin,transport-user-add'],                  'uses' => 'TransportUserController@add']);
    Route::post('user/store',             ['as' => '.user.store',               'middleware' => ['ability:super-admin,transport-user-add'],                  'uses' => 'TransportUserController@store']);
    Route::get('user/{id}/edit',          ['as' => '.user.edit',                'middleware' => ['ability:super-admin,transport-user-edit'],                 'uses' => 'TransportUserController@edit']);
    Route::post('user/{id}/update',       ['as' => '.user.update',              'middleware' => ['ability:super-admin,transport-user-edit'],                 'uses' => 'TransportUserController@update']);
    Route::get('user/{id}/delete',        ['as' => '.user.delete',              'middleware' => ['ability:super-admin,transport-user-delete'],               'uses' => 'TransportUserController@delete']);
    Route::post('user/bulk-action',       ['as' => '.user.bulk-action',         'middleware' => ['ability:super-admin,transport-user-bulk-action'],          'uses' => 'TransportUserController@bulkAction']);
    Route::post('user/renew',             ['as' => '.user.renew',               'middleware' => ['ability:super-admin,transport-user-renew'],                 'uses' => 'TransportUserController@renew']);
    Route::get('user/{id}/leave',         ['as' => '.user.leave',               'middleware' => ['ability:super-admin,transport-user-leave'],                 'uses' => 'TransportUserController@leave']);
    Route::post('user/shift',             ['as' => '.user.shift',               'middleware' => ['ability:super-admin,transport-user-shift'],                 'uses' => 'TransportUserController@shift']);
    Route::get('user/history',            ['as' => '.user.history',             'middleware' => ['ability:super-admin,transport-user-history'],               'uses' => 'TransportUserController@history']);
    Route::post('find-vehicles',            ['as' => '.find-vehicles',                                                                            'uses' => 'TransportUserController@findVehicles']);

});

/*Report Grouping*/
Route::group(['prefix' => 'report/',                                    'as' => 'report',                                       'namespace' => 'Report\\'], function () {

    Route::get('student',           ['as' => '.student',            'middleware' => ['ability:super-admin,student-report'],      'uses' => 'StudentReportController@index']);
    Route::get('staff',             ['as' => '.staff',              'middleware' => ['ability:super-admin,staff-report'],        'uses' => 'StaffReportController@index']);
});

/*Info Center Grouping*/
Route::group(['prefix' => 'info/',                                      'as' => 'info.',                                        'namespace' => 'Info\\'], function () {

    /*Notice Board Routes*/
    Route::get('notice',                            ['as' => 'notice',                                  'middleware' => ['ability:super-admin,notice-index'],           'uses' => 'NoticeBoardController@index']);
    Route::get('notice/add',                        ['as' => 'notice.add',                              'middleware' => ['ability:super-admin,notice-add'],             'uses' => 'NoticeBoardController@add']);
    Route::post('notice/store',                     ['as' => 'notice.store',                            'middleware' => ['ability:super-admin,notice-add'],             'uses' => 'NoticeBoardController@store']);
    Route::get('notice/{id}/edit',                  ['as' => 'notice.edit',                             'middleware' => ['ability:super-admin,notice-edit'],            'uses' => 'NoticeBoardController@edit']);
    Route::post('notice/{id}/update',               ['as' => 'notice.update',                           'middleware' => ['ability:super-admin,notice-edit'],            'uses' => 'NoticeBoardController@update']);
    Route::get('notice/{id}/delete',                ['as' => 'notice.delete',                           'middleware' => ['ability:super-admin,notice-delete'],          'uses' => 'NoticeBoardController@delete']);

    /*SMS Email Routes*/
    Route::get('smsemail',                          ['as' => 'smsemail',                                'middleware' => ['ability:super-admin,sms-email-index'],                     'uses' => 'SmsEmailController@index']);
    Route::get('smsemail/{id}/delete',              ['as' => 'smsemail.delete',                         'middleware' => ['ability:super-admin,sms-email-delete'],                    'uses' => 'SmsEmailController@delete']);
    Route::post('smsemail/bulk-action',             ['as' => 'smsemail.bulk-action',                    'middleware' => ['ability:super-admin,sms-email-bulk-action'],               'uses' => 'SmsEmailController@bulkAction']);

    /*Group*/
    Route::get('smsemail/create',                   ['as' => 'smsemail.create',                         'middleware' => ['ability:super-admin,sms-email-create'],                   'uses' => 'SmsEmailController@create']);
    Route::post('smsemail/send',                    ['as' => 'smsemail.send',                           'middleware' => ['ability:super-admin,sms-email-send'],                     'uses' => 'SmsEmailController@send']);

    /*StudentGuardian*/
    Route::get('smsemail/student-guardian',         ['as' => 'smsemail.student-guardian',              'middleware' => ['ability:super-admin,sms-email-create'],                     'uses' => 'SmsEmailController@studentGuardian']);
    Route::post('smsemail/student-guardian/send',   ['as' => 'smsemail.student-guardian.send',         'middleware' => ['ability:super-admin,sms-email-student-guardian-send'],      'uses' => 'SmsEmailController@studentGuardianSend']);

    /*StudentGuardian*/
    Route::get('smsemail/staff',                    ['as' => 'smsemail.staff',                          'middleware' => ['ability:super-admin,sms-email-create'],                   'uses' => 'SmsEmailController@staff']);
    Route::post('smsemail/staff/send',              ['as' => 'smsemail.staff.send',                     'middleware' => ['ability:super-admin,sms-email-staff-send'],                'uses' => 'SmsEmailController@staffSend']);

    /*Individual*/
    Route::get('smsemail/individual',               ['as' => 'smsemail.individual',                     'middleware' => ['ability:super-admin,sms-email-create'],                   'uses' => 'SmsEmailController@individual']);
    Route::post('smsemail/individual/send',         ['as' => 'smsemail.individual.send',                'middleware' => ['ability:super-admin,sms-email-individual-send'],           'uses' => 'SmsEmailController@individualSend']);

    /*Reminder Alert*/
    Route::get('smsemail/{id}/fees-receipt',        ['as' => 'smsemail.fees-receipt',                   'middleware' => ['ability:super-admin,sms-email-fee-receipt'],               'uses' => 'SmsEmailController@feeReceipt']);
    Route::post('smsemail/dueReminder',             ['as' => 'smsemail.dueReminder',                    'middleware' => ['ability:super-admin,sms-email-due-reminder'],              'uses' => 'SmsEmailController@dueReminder']);
    Route::post('smsemail/bookReturnReminder',      ['as' => 'smsemail.bookReturnReminder',             'middleware' => ['ability:super-admin,sms-email-book-return-reminder'],      'uses' => 'SmsEmailController@bookReturnReminder']);

});

/*Print Grouping*/
Route::group(['prefix' => 'print-out/',                                 'as' => 'print-out.',                                   'namespace' => 'PrintOut\\'], function () {
    /*Print Fees*/
    Route::get('fees/master-receipt/{id}',              ['as' => 'fees.master-receipt',                     'middleware' => ['ability:super-admin,fee-print-master'],                   'uses' => 'FeesPrintController@printMaster']);

    Route::get('fees/collection/{id}',                  ['as' => 'fees.collection',                         'middleware' => ['ability:super-admin,fee-print-collection'],               'uses' => 'FeesPrintController@printCollection']);
    Route::get('fees/today-receipt/{id}',               ['as' => 'fees.today-receipt',                      'middleware' => ['ability:super-admin,fee-print-today-receipt'],            'uses' => 'FeesPrintController@todayReceiptAmount']);
    Route::get('fees/today-receipt-detail/{id}',        ['as' => 'fees.today-receipt-detail',               'middleware' => ['ability:super-admin,fee-print-today-detail-receipt'],     'uses' => 'FeesPrintController@todayReceiptDetail']);
    Route::get('fees/student-ledger/{id}',              ['as' => 'fees.student-ledger',                     'middleware' => ['ability:super-admin,fee-print-student-ledger'],           'uses' => 'FeesPrintController@studentLedger']);

    Route::get('fees/student-due/{id}',                 ['as' => 'fees.student-due',                        'middleware' => ['ability:super-admin,fee-print-student-due'],              'uses' => 'FeesPrintController@studentDue']);
    Route::get('fees/student-due-detail/{id}',          ['as' => 'fees.student-due-detail',                 'middleware' => ['ability:super-admin,fee-print-student-due-detail'],       'uses' => 'FeesPrintController@studentDueDetail']);

    Route::post('fees/bulk-due-slip',                   ['as' => 'fees.bulk-due-slip',                       'middleware' => ['ability:super-admin,fee-print-bulk-due-slip'],           'uses' => 'FeesPrintController@bulkDueSlip']);
    Route::post('fees/bulk-due-detail-slip',            ['as' => 'fees.bulk-due-detail-slip',                'middleware' => ['ability:super-admin,fee-print-bulk-due-detail-slip'],    'uses' => 'FeesPrintController@bulkDueDetailSlip']);

    Route::post('exam/admit-card',                      ['as' => 'exam.admit-card',                         'middleware' => ['ability:super-admin,exam-print-admitcard'],                     'uses' => 'ExamPrintController@admitCard']);
    Route::post('exam/routine',                         ['as' => 'exam.routine',                            'middleware' => ['ability:super-admin,exam-print-routine'],                       'uses' => 'ExamPrintController@examRoutine']);
    Route::post('exam/mark-sheet/',                     ['as' => 'exam.mark-sheet',                         'middleware' => ['ability:super-admin,exam-print-mark-sheet'],                    'uses' => 'ExamPrintController@examMarkSheet']);
    Route::post('exam/grade-sheet/',                     ['as' => 'exam.grade-sheet',                         'middleware' => ['ability:super-admin,exam-print-mark-sheet'],                    'uses' => 'ExamPrintController@examGradeSheet']);

});

/*Academic Grouping */
Route::group(['prefix' => '/',                                          'as' => '',                                             'namespace' => 'Academic\\'], function () {
    /*faculty Routes*/
    Route::get('faculty',                    ['as' => 'faculty',                  'middleware' => ['ability:super-admin,faculty-index'],            'uses' => 'FacultyController@index']);
    Route::post('faculty/store',             ['as' => 'faculty.store',            'middleware' => ['ability:super-admin,faculty-add'],              'uses' => 'FacultyController@store']);
    Route::get('faculty/{id}/edit',          ['as' => 'faculty.edit',             'middleware' => ['ability:super-admin,faculty-edit'],             'uses' => 'FacultyController@edit']);
    Route::post('faculty/{id}/update',       ['as' => 'faculty.update',           'middleware' => ['ability:super-admin,faculty-edit'],             'uses' => 'FacultyController@update']);
    Route::get('faculty/{id}/delete',        ['as' => 'faculty.delete',           'middleware' => ['ability:super-admin,faculty-delete'],           'uses' => 'FacultyController@delete']);
    Route::get('faculty/{id}/active',        ['as' => 'faculty.active',           'middleware' => ['ability:super-admin,faculty-active'],           'uses' => 'FacultyController@Active']);
    Route::get('faculty/{id}/in-active',     ['as' => 'faculty.in-active',        'middleware' => ['ability:super-admin,faculty-in-active'],        'uses' => 'FacultyController@inActive']);
    Route::post('faculty/bulk-action',       ['as' => 'faculty.bulk-action',      'middleware' => ['ability:super-admin,faculty-bulk-action'],      'uses' => 'FacultyController@bulkAction']);

    /*semester Routes*/
    Route::get('semester',                    ['as' => 'semester',                  'middleware' => ['ability:super-admin,semester-index'],             'uses' => 'SemesterController@index']);
    Route::post('semester/store',             ['as' => 'semester.store',            'middleware' => ['ability:super-admin,semester-add'],               'uses' => 'SemesterController@store']);
    Route::get('semester/{id}/edit',          ['as' => 'semester.edit',             'middleware' => ['ability:super-admin,semester-edit'],              'uses' => 'SemesterController@edit']);
    Route::post('semester/{id}/update',       ['as' => 'semester.update',           'middleware' => ['ability:super-admin,semester-edit'],              'uses' => 'SemesterController@update']);
    Route::get('semester/{id}/delete',        ['as' => 'semester.delete',           'middleware' => ['ability:super-admin,semester-delete'],            'uses' => 'SemesterController@delete']);
    Route::get('semester/{id}/active',        ['as' => 'semester.active',           'middleware' => ['ability:super-admin,semester-active'],            'uses' => 'SemesterController@Active']);
    Route::get('semester/{id}/in-active',     ['as' => 'semester.in-active',        'middleware' => ['ability:super-admin,semester-in-active'],         'uses' => 'SemesterController@inActive']);
    Route::post('semester/bulk-action',       ['as' => 'semester.bulk-action',      'middleware' => ['ability:super-admin,semester-bulk-action'],       'uses' => 'SemesterController@bulkAction']);
    Route::post('semester/subject-html',        ['as' => 'semester.subject-html',                                                                       'uses' => 'SemesterController@subjectHtmlRow']);

    /*Grading Type & Scale*/
    Route::get('grading',                    ['as' => 'grading',                  'middleware' => ['ability:super-admin,grading-index'],                'uses' => 'GradingController@index']);
    Route::post('grading/store',             ['as' => 'grading.store',            'middleware' => ['ability:super-admin,grading-add'],                  'uses' => 'GradingController@store']);
    Route::get('grading/{id}/edit',          ['as' => 'grading.edit',             'middleware' => ['ability:super-admin,grading-edit'],                 'uses' => 'GradingController@edit']);
    Route::post('grading/{id}/update',       ['as' => 'grading.update',           'middleware' => ['ability:super-admin,grading-edit'],                 'uses' => 'GradingController@update']);
    Route::get('grading/{id}/delete',        ['as' => 'grading.delete',           'middleware' => ['ability:super-admin,grading-delete'],               'uses' => 'GradingController@delete']);
    Route::get('grading/{id}/active',        ['as' => 'grading.active',           'middleware' => ['ability:super-admin,grading-active'],               'uses' => 'GradingController@Active']);
    Route::get('grading/{id}/in-active',     ['as' => 'grading.in-active',        'middleware' => ['ability:super-admin,grading-in-active'],            'uses' => 'GradingController@inActive']);
    Route::post('grading/bulk-action',       ['as' => 'grading.bulk-action',      'middleware' => ['ability:super-admin,grading-bulk-action'],          'uses' => 'GradingController@bulkAction']);
    Route::post('grading/grade-html',        ['as' => 'grading.grade-html',                                                                                 'uses' => 'GradingController@gradeHtmlRow']);

    /*Subject*/
    Route::get('subject',                    ['as' => 'subject',                  'middleware' => ['ability:super-admin,subject-index'],                'uses' => 'SubjectController@index']);
    Route::post('subject/store',             ['as' => 'subject.store',            'middleware' => ['ability:super-admin,subject-add'],                  'uses' => 'SubjectController@store']);
    Route::get('subject/{id}/edit',          ['as' => 'subject.edit',             'middleware' => ['ability:super-admin,subject-edit'],                 'uses' => 'SubjectController@edit']);
    Route::post('subject/{id}/update',       ['as' => 'subject.update',           'middleware' => ['ability:super-admin,subject-edit'],                 'uses' => 'SubjectController@update']);
    Route::get('subject/{id}/delete',        ['as' => 'subject.delete',           'middleware' => ['ability:super-admin,subject-delete'],               'uses' => 'SubjectController@delete']);
    Route::get('subject/{id}/active',        ['as' => 'subject.active',           'middleware' => ['ability:super-admin,subject-active'],               'uses' => 'SubjectController@Active']);
    Route::get('subject/{id}/in-active',     ['as' => 'subject.in-active',        'middleware' => ['ability:super-admin,subject-in-active'],            'uses' => 'SubjectController@inActive']);
    Route::post('subject/bulk-action',       ['as' => 'subject.bulk-action',      'middleware' => ['ability:super-admin,subject-bulk-action'],          'uses' => 'SubjectController@bulkAction']);
    Route::get('subject-name-autocomplete',  ['as' => 'subject-name-autocomplete',                                                                      'uses' => 'SubjectController@subjectNameAutocomplete']);

    /*Student Status Routes*/
    Route::get('student-status',                    ['as' => 'student-status',                  'middleware' => ['ability:super-admin,student-status-index'],               'uses' => 'StudentStatusController@index']);
    Route::post('student-status/store',             ['as' => 'student-status.store',            'middleware' => ['ability:super-admin,student-status-add'],                 'uses' => 'StudentStatusController@store']);
    Route::get('student-status/{id}/edit',          ['as' => 'student-status.edit',             'middleware' => ['ability:super-admin,student-status-edit'],                'uses' => 'StudentStatusController@edit']);
    Route::post('student-status/{id}/update',       ['as' => 'student-status.update',           'middleware' => ['ability:super-admin,student-status-edit'],                'uses' => 'StudentStatusController@update']);
    Route::get('student-status/{id}/delete',        ['as' => 'student-status.delete',           'middleware' => ['ability:super-admin,student-status-delete'],              'uses' => 'StudentStatusController@delete']);
    Route::get('student-status/{id}/active',        ['as' => 'student-status.active',           'middleware' => ['ability:super-admin,student-status-active'],              'uses' => 'StudentStatusController@Active']);
    Route::get('student-status/{id}/in-active',     ['as' => 'student-status.in-active',        'middleware' => ['ability:super-admin,student-status-in-active'],           'uses' => 'StudentStatusController@inActive']);
    Route::post('student-status/bulk-action',       ['as' => 'student-status.bulk-action',      'middleware' => ['ability:super-admin,student-status-bulk-action'],         'uses' => 'StudentStatusController@bulkAction']);

    /*Book Status Routes*/
    Route::get('attendance-status',                    ['as' => 'attendance-status',                  'middleware' => ['ability:super-admin,attendance-status-index'],            'uses' => 'AttendanceStatusController@index']);
    Route::post('attendance-status/store',             ['as' => 'attendance-status.store',            'middleware' => ['ability:super-admin,attendance-status-add'],              'uses' => 'AttendanceStatusController@store']);
    Route::get('attendance-status/{id}/edit',          ['as' => 'attendance-status.edit',             'middleware' => ['ability:super-admin,attendance-status-edit'],             'uses' => 'AttendanceStatusController@edit']);
    Route::post('attendance-status/{id}/update',       ['as' => 'attendance-status.update',           'middleware' => ['ability:super-admin,attendance-status-edit'],             'uses' => 'AttendanceStatusController@update']);
    Route::get('attendance-status/{id}/delete',        ['as' => 'attendance-status.delete',           'middleware' => ['ability:super-admin,attendance-status-delete'],           'uses' => 'AttendanceStatusController@delete']);
    Route::get('attendance-status/{id}/active',        ['as' => 'attendance-status.active',           'middleware' => ['ability:super-admin,attendance-status-active'],           'uses' => 'AttendanceStatusController@Active']);
    Route::get('attendance-status/{id}/in-active',     ['as' => 'attendance-status.in-active',        'middleware' => ['ability:super-admin,attendance-status-in-active'],        'uses' => 'AttendanceStatusController@inActive']);
    Route::post('attendance-status/bulk-action',       ['as' => 'attendance-status.bulk-action',      'middleware' => ['ability:super-admin,attendance-status-bulk-action'],      'uses' => 'AttendanceStatusController@bulkAction']);

    /*Book Status Routes*/
    Route::get('book-status',                    ['as' => 'book-status',                  'middleware' => ['ability:super-admin,book-status-index'],            'uses' => 'BookStatusController@index']);
    Route::post('book-status/store',             ['as' => 'book-status.store',            'middleware' => ['ability:super-admin,book-status-add'],              'uses' => 'BookStatusController@store']);
    Route::get('book-status/{id}/edit',          ['as' => 'book-status.edit',             'middleware' => ['ability:super-admin,book-status-edit'],             'uses' => 'BookStatusController@edit']);
    Route::post('book-status/{id}/update',       ['as' => 'book-status.update',           'middleware' => ['ability:super-admin,book-status-edit'],             'uses' => 'BookStatusController@update']);
    Route::get('book-status/{id}/delete',        ['as' => 'book-status.delete',           'middleware' => ['ability:super-admin,book-status-delete'],           'uses' => 'BookStatusController@delete']);
    Route::get('book-status/{id}/active',        ['as' => 'book-status.active',           'middleware' => ['ability:super-admin,book-status-active'],           'uses' => 'BookStatusController@Active']);
    Route::get('book-status/{id}/in-active',     ['as' => 'book-status.in-active',        'middleware' => ['ability:super-admin,book-status-in-active'],        'uses' => 'BookStatusController@inActive']);
    Route::post('book-status/bulk-action',       ['as' => 'book-status.bulk-action',      'middleware' => ['ability:super-admin,book-status-bulk-action'],      'uses' => 'BookStatusController@bulkAction']);

    /*Hostel Room Beds Status Routes*/
    Route::get('bed-status',                    ['as' => 'bed-status',                  'middleware' => ['ability:super-admin,bed-status-index'],               'uses' => 'BedStatusController@index']);
    Route::post('bed-status/store',             ['as' => 'bed-status.store',            'middleware' => ['ability:super-admin,bed-status-add'],                 'uses' => 'BedStatusController@store']);
    Route::get('bed-status/{id}/edit',          ['as' => 'bed-status.edit',             'middleware' => ['ability:super-admin,bed-status-edit'],                'uses' => 'BedStatusController@edit']);
    Route::post('bed-status/{id}/update',       ['as' => 'bed-status.update',           'middleware' => ['ability:super-admin,bed-status-edit'],                'uses' => 'BedStatusController@update']);
    Route::get('bed-status/{id}/delete',        ['as' => 'bed-status.delete',           'middleware' => ['ability:super-admin,bed-status-delete'],              'uses' => 'BedStatusController@delete']);
    Route::get('bed-status/{id}/active',        ['as' => 'bed-status.active',           'middleware' => ['ability:super-admin,bed-status-active'],              'uses' => 'BedStatusController@Active']);
    Route::get('bed-status/{id}/in-active',     ['as' => 'bed-status.in-active',        'middleware' => ['ability:super-admin,bed-status-in-active'],           'uses' => 'BedStatusController@inActive']);
    Route::post('bed-status/bulk-action',       ['as' => 'bed-status.bulk-action',      'middleware' => ['ability:super-admin,bed-status-bulk-action'],          'uses' => 'BedStatusController@bulkAction']);

    /*Year Routes*/
    Route::get('year',                    ['as' => 'year',                  'middleware' => ['ability:super-admin,year-index'],            'uses' => 'YearsController@index']);
    Route::post('year/store',             ['as' => 'year.store',            'middleware' => ['ability:super-admin,year-add'],              'uses' => 'YearsController@store']);
    Route::get('year/{id}/edit',          ['as' => 'year.edit',             'middleware' => ['ability:super-admin,year-edit'],             'uses' => 'YearsController@edit']);
    Route::post('year/{id}/update',       ['as' => 'year.update',           'middleware' => ['ability:super-admin,year-edit'],             'uses' => 'YearsController@update']);
    Route::get('year/{id}/delete',        ['as' => 'year.delete',           'middleware' => ['ability:super-admin,year-delete'],           'uses' => 'YearsController@delete']);
    Route::get('year/{id}/active',        ['as' => 'year.active',           'middleware' => ['ability:super-admin,year-active'],           'uses' => 'YearsController@Active']);
    Route::get('year/{id}/in-active',     ['as' => 'year.in-active',        'middleware' => ['ability:super-admin,year-in-active'],        'uses' => 'YearsController@inActive']);
    Route::post('year/bulk-action',       ['as' => 'year.bulk-action',      'middleware' => ['ability:super-admin,year-bulk-action'],      'uses' => 'YearsController@bulkAction']);
    Route::get('year/{id}/active-status', ['as' => 'year.active-status',    'middleware' => ['ability:super-admin,year-active-status'],    'uses' => 'YearsController@activeStatus']);

    /*Months Routes*/
    Route::get('month',                    ['as' => 'month',                  'middleware' => ['ability:super-admin,month-index'],          'uses' => 'MonthsController@index']);
    Route::post('month/store',             ['as' => 'month.store',            'middleware' => ['ability:super-admin,month-add'],            'uses' => 'MonthsController@store']);
    Route::get('month/{id}/edit',          ['as' => 'month.edit',             'middleware' => ['ability:super-admin,month-edit'],           'uses' => 'MonthsController@edit']);
    Route::post('month/{id}/update',       ['as' => 'month.update',           'middleware' => ['ability:super-admin,month-edit'],           'uses' => 'MonthsController@update']);
    Route::get('month/{id}/delete',        ['as' => 'month.delete',           'middleware' => ['ability:super-admin,month-delete'],         'uses' => 'MonthsController@delete']);
    Route::get('month/{id}/active',        ['as' => 'month.active',           'middleware' => ['ability:super-admin,month-active'],         'uses' => 'MonthsController@Active']);
    Route::get('month/{id}/in-active',     ['as' => 'month.in-active',        'middleware' => ['ability:super-admin,month-in-active'],      'uses' => 'MonthsController@inActive']);
    Route::post('month/bulk-action',       ['as' => 'month.bulk-action',      'middleware' => ['ability:super-admin,month-bulk-action'],    'uses' => 'MonthsController@bulkAction']);

    /*Day Routes*/
    Route::get('day',                    ['as' => 'day',                  'middleware' => ['ability:super-admin,day-index'],            'uses' => 'DayController@index']);
    Route::post('day/store',             ['as' => 'day.store',            'middleware' => ['ability:super-admin,day-add'],              'uses' => 'DayController@store']);
    Route::get('day/{id}/edit',          ['as' => 'day.edit',             'middleware' => ['ability:super-admin,day-edit'],             'uses' => 'DayController@edit']);
    Route::post('day/{id}/update',       ['as' => 'day.update',           'middleware' => ['ability:super-admin,day-edit'],             'uses' => 'DayController@update']);
    Route::get('day/{id}/delete',        ['as' => 'day.delete',           'middleware' => ['ability:super-admin,day-delete'],           'uses' => 'DayController@delete']);
    Route::get('day/{id}/active',        ['as' => 'day.active',           'middleware' => ['ability:super-admin,day-active'],           'uses' => 'DayController@Active']);
    Route::get('day/{id}/in-active',     ['as' => 'day.in-active',        'middleware' => ['ability:super-admin,day-in-active'],        'uses' => 'DayController@inActive']);
    Route::post('day/bulk-action',       ['as' => 'day.bulk-action',      'middleware' => ['ability:super-admin,day-bulk-action'],      'uses' => 'DayController@bulkAction']);

});

/*Setting Grouping */
Route::group(['prefix' => 'setting/',                                   'as' => 'setting',                                      'namespace' => 'Setting\\'], function () {
    /* General Setting Routes */
    Route::get('general',                    ['as' => '.general',                  'middleware' => ['ability:super-admin,general-setting-index'],           'uses' => 'GeneralSettingController@index']);
    Route::get('general/add',                ['as' => '.general.add',              'middleware' => ['ability:super-admin,general-setting-add'],             'uses' => 'GeneralSettingController@add']);
    Route::post('general/store',             ['as' => '.general.store',            'middleware' => ['ability:super-admin,general-setting-add'],             'uses' => 'GeneralSettingController@store']);
    Route::get('general/{id}/edit',          ['as' => '.general.edit',             'middleware' => ['ability:super-admin,general-setting-edit'],            'uses' => 'GeneralSettingController@edit']);
    Route::post('general/{id}/update',       ['as' => '.general.update',           'middleware' => ['ability:super-admin,general-setting-edit'],            'uses' => 'GeneralSettingController@update']);

    /* Alert Setting Routes */
    Route::get('alert',                    ['as' => '.alert',                   'middleware' => ['ability:super-admin,alert-setting-index'],        'uses' => 'AlertSettingController@index']);
    Route::get('alert/add',                ['as' => '.alert.add',               'middleware' => ['ability:super-admin,alert-setting-add'],          'uses' => 'AlertSettingController@add']);
    Route::post('alert/store',             ['as' => '.alert.store',             'middleware' => ['ability:super-admin,alert-setting-add'],          'uses' => 'AlertSettingController@store']);
    Route::get('alert/{id}/edit',          ['as' => '.alert.edit',              'middleware' => ['ability:super-admin,alert-setting-edit'],         'uses' => 'AlertSettingController@edit']);
    Route::post('alert/{id}/update',       ['as' => '.alert.update',            'middleware' => ['ability:super-admin,alert-setting-edit'],         'uses' => 'AlertSettingController@update']);

    /* SMS Setting Routes */
    Route::get('sms',                    ['as' => '.sms',                           'middleware' => ['ability:super-admin,sms-setting-index'],              'uses' => 'SmsSettingController@index']);
    Route::get('sms/add',                ['as' => '.sms.add',                       'middleware' => ['ability:super-admin,sms-setting-add'],                'uses' => 'SmsSettingController@add']);
    Route::post('sms/store',             ['as' => '.sms.store',                     'middleware' => ['ability:super-admin,sms-setting-add'],                'uses' => 'SmsSettingController@store']);
    Route::get('sms/{id}/edit',          ['as' => '.sms.edit',                      'middleware' => ['ability:super-admin,sms-setting-edit'],               'uses' => 'SmsSettingController@edit']);
    Route::post('sms/{id}/update',       ['as' => '.sms.update',                    'middleware' => ['ability:super-admin,sms-setting-edit'],               'uses' => 'SmsSettingController@update']);
    Route::get('sms/{id}/active',        ['as' => '.sms.active',                    'middleware' => ['ability:super-admin,sms-active'],                      'uses' => 'SmsSettingController@Active']);
    Route::get('sms/{id}/in-active',     ['as' => '.sms.in-active',                 'middleware' => ['ability:super-admin,sms-in-active'],                  'uses' => 'SmsSettingController@inActive']);

    /* Email Setting Routes */
    Route::get('email',                    ['as' => '.email',                       'middleware' => ['ability:super-admin,email-setting-index'],                'uses' => 'EmailSettingController@index']);
    Route::get('email/add',                ['as' => '.email.add',                   'middleware' => ['ability:super-admin,email-setting-add'],                  'uses' => 'EmailSettingController@add']);
    Route::post('email/store',             ['as' => '.email.store',                 'middleware' => ['ability:super-admin,email-setting-add'],                  'uses' => 'EmailSettingController@store']);
    Route::get('email/{id}/edit',          ['as' => '.email.edit',                  'middleware' => ['ability:super-admin,email-setting-edit'],                 'uses' => 'EmailSettingController@edit']);
    Route::post('email/{id}/update',       ['as' => '.email.update',                'middleware' => ['ability:super-admin,email-setting-edit'],                 'uses' => 'EmailSettingController@update']);
    Route::post('email/change-status',     ['as' => '.email.change-status',         'middleware' => ['ability:super-admin,email-setting-status-change'],        'uses' => 'EmailSettingController@statusChange']);

    /* Email Setting Routes */
    Route::get('payment-gateway',                    ['as' => '.payment-gateway',                       'middleware' => ['ability:super-admin,payment-gateway-setting-index'],                'uses' => 'PaymentSettingController@index']);
    Route::get('payment-gateway/add',                ['as' => '.payment-gateway.add',                   'middleware' => ['ability:super-admin,payment-gateway-setting-add'],                  'uses' => 'PaymentSettingController@add']);
    Route::post('payment-gateway/store',             ['as' => '.payment-gateway.store',                 'middleware' => ['ability:super-admin,payment-gateway-setting-add'],                  'uses' => 'PaymentSettingController@store']);
    Route::get('payment-gateway/{id}/edit',          ['as' => '.payment-gateway.edit',                  'middleware' => ['ability:super-admin,payment-gateway-setting-edit'],                 'uses' => 'PaymentSettingController@edit']);
    Route::post('payment-gateway/{id}/update',       ['as' => '.payment-gateway.update',                'middleware' => ['ability:super-admin,payment-gateway-setting-edit'],                 'uses' => 'PaymentSettingController@update']);
    Route::get('payment-gateway/{id}/active',        ['as' => '.payment-gateway.active',                 'middleware' => ['ability:super-admin,payment-gateway-active'],                       'uses' => 'PaymentSettingController@Active']);
    Route::get('payment-gateway/{id}/in-active',     ['as' => '.payment-gateway.in-active',              'middleware' => ['ability:super-admin,payment-gateway-in-active'],                     'uses' => 'PaymentSettingController@inActive']);

});


/*Extra Features Grouping */

/*Assignment Grouping */
Route::group(['prefix' => 'assignment/',                                    'as' => 'assignment',                                       'namespace' => 'Assignment\\'], function () {

    /*Assignment Routes*/
    Route::get('',                   ['as' => '',                  'middleware' => ['ability:super-admin,assignment-index'],                'uses' => 'AssignmentController@index']);
    Route::get('add',                ['as' => '.add',              'middleware' => ['ability:super-admin,assignment-add'],                  'uses' => 'AssignmentController@add']);
    Route::post('store',             ['as' => '.store',            'middleware' => ['ability:super-admin,assignment-add'],                  'uses' => 'AssignmentController@store']);
    Route::get('{id}/edit',          ['as' => '.edit',             'middleware' => ['ability:super-admin,assignment-edit'],                 'uses' => 'AssignmentController@edit']);
    Route::post('{id}/update',       ['as' => '.update',           'middleware' => ['ability:super-admin,assignment-edit'],                 'uses' => 'AssignmentController@update']);
    Route::get('{id}/view',          ['as' => '.view',             'middleware' => ['ability:super-admin,assignment-view'],                 'uses' => 'AssignmentController@view']);
    Route::get('{id}/delete',        ['as' => '.delete',           'middleware' => ['ability:super-admin,assignment-delete'],               'uses' => 'AssignmentController@delete']);
    Route::get('{id}/active',        ['as' => '.active',           'middleware' => ['ability:super-admin,assignment-active'],               'uses' => 'AssignmentController@Active']);
    Route::get('{id}/in-active',     ['as' => '.in-active',        'middleware' => ['ability:super-admin,assignment-in-active'],            'uses' => 'AssignmentController@inActive']);
    Route::post('bulk-action',       ['as' => '.bulk-action',      'middleware' => ['ability:super-admin,assignment-bulk-action'],          'uses' => 'AssignmentController@bulkAction']);

    Route::post('find-semester',                    ['as' => '.find-semester',                                                              'uses' => 'AssignmentController@findSemester']);
    Route::post('mark-ledger/find-subject',         ['as' => '.find-subject',                                                               'uses' => 'AssignmentController@findSubject']);

    /*Answer Routes*/
    Route::get('answer/{id}/{answer}/view',     ['as' => '.answer.view',                'middleware' => ['ability:super-admin,assignment-answer-view'],                 'uses' => 'AssignmentController@viewAnswer']);
    Route::get('answer/{id}/approve',           ['as' => '.answer.approve',             'middleware' => ['ability:super-admin,assignment-answer-approve'],              'uses' => 'AssignmentController@approveAnswer']);
    Route::get('answer/{id}/reject',            ['as' => '.answer.reject',              'middleware' => ['ability:super-admin,assignment-answer-reject'],               'uses' => 'AssignmentController@rejectAnswer']);
    Route::get('answer/{id}/delete',            ['as' => '.answer.delete',              'middleware' => ['ability:super-admin,assignment-answer-delete'],               'uses' => 'AssignmentController@deleteAnswer']);

    Route::post('answer/bulk-action',           ['as' => '.answer.bulk-action',      'middleware' => ['ability:super-admin,assignment-answer-bulk-action'],             'uses' => 'AssignmentController@bulkActionAnswer']);
});

/*Download Grouping */
Route::group(['prefix' => 'download/',                                    'as' => 'download',                                       'namespace' => 'Download\\'], function () {
    /*Download Routes*/
    Route::get('',                   ['as' => '',                  'middleware' => ['ability:super-admin,download-index'],                'uses' => 'DownloadController@index']);
    Route::post('store',             ['as' => '.store',            'middleware' => ['ability:super-admin,download-add'],                  'uses' => 'DownloadController@store']);
    Route::get('{id}/edit',          ['as' => '.edit',             'middleware' => ['ability:super-admin,download-edit'],                 'uses' => 'DownloadController@edit']);
    Route::post('{id}/update',       ['as' => '.update',           'middleware' => ['ability:super-admin,download-edit'],                 'uses' => 'DownloadController@update']);
    Route::get('{id}/delete',        ['as' => '.delete',           'middleware' => ['ability:super-admin,download-delete'],               'uses' => 'DownloadController@delete']);
    Route::get('{id}/active',        ['as' => '.active',           'middleware' => ['ability:super-admin,download-active'],               'uses' => 'DownloadController@Active']);
    Route::get('{id}/in-active',     ['as' => '.in-active',        'middleware' => ['ability:super-admin,download-in-active'],            'uses' => 'DownloadController@inActive']);
    Route::post('bulk-action',       ['as' => '.bulk-action',      'middleware' => ['ability:super-admin,download-bulk-action'],          'uses' => 'DownloadController@bulkAction']);
});


