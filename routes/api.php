<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\ClassStudentsController;
use App\Http\Controllers\DelayController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FollowUpTypeController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionRecordeController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionAdsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\SubjectsClassController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\WorkingPapersSectionController;
use App\Http\Controllers\WorkingPapersTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//SubjectsClassController
//StudentsController
//DelayController
//AbsenceController
//PermissionController
//SectionsController
//FollowUpTypeController
//ClassStudentsController
//MarksController
//AdsController
//EmployeeController
//UserRoleController
//Route::get('/showClass', [ClassStudentsController::class, 'showClass']);// 2
//StudyProgramController
//maria==================================
Route::post('/store', [StudentsController::class, 'storeStudent']);//
Route::post('/showStudent', [StudentsController::class, 'indexStudent']);//
Route::get('/detailStudent/{studentId}', [StudentsController::class, 'showDetailStudent']);
Route::get('/deleteStudent/{idStudent}', [StudentsController::class, 'destroyStudent']);//
Route::get('/allStudent', [StudentsController::class, 'allStudent']);//
Route::post('/indexDelay', [DelayController::class, 'indexDaley']);//
Route::get('/indexAbsence/{idStudent}', [AbsenceController::class, 'indexAbsence']);
Route::post('/indexPermission', [PermissionController::class, 'indexPermission']);//
Route::post('/storeDelay', [DelayController::class, 'storeDaley']);//
Route::post('/storeAbsence', [AbsenceController::class, 'storeAbsence']);
Route::post('/updateAbsence', [AbsenceController::class, 'updateAbsenceReason']);
Route::post('/storePermission', [PermissionController::class, 'storePermission']);//
Route::post('/showAbsenceStudent', [AbsenceController::class, 'showAbsence']);
Route::post('/showSection', [SectionsController::class, 'showSection']);//
Route::get('/showClass', [ClassStudentsController::class, 'showClass']);//
Route::post('/showSubject', [SubjectsClassController::class, 'showSubject']);
Route::get('/showType', [FollowUpTypeController::class, 'showType']);
Route::post('/showStudentMark/{idSubject}/{idType}', [MarksController::class, 'showStudentMark']);
Route::post('/storeMark/{idSubject}/{idType}', [MarksController::class, 'storeMark']);
Route::get('/showDetailsMark/{idStudent}/{idType}/{idSubject}', [MarksController::class, 'indexMarkDetail']);
Route::post('/updateMark', [MarksController::class, 'editMark']);
Route::get('/deleteMark/{idMark}', [MarksController::class, 'destroyMark']);
Route::post('/upload', [AdsController::class, 'storeFile']);
Route::post('/showSectionAds', [AdsController::class, 'indexSectionAds']);
Route::delete('/upload', [AdsController::class, 'destroyFile']);
Route::post('/upload', [AdsController::class, 'storeFile']);
Route::post('/showSectionAds', [AdsController::class, 'indexSectionAds']);
Route::delete('/upload/{idFile}', [AdsController::class, 'destroyFile']);
//maria===================================================
Route::post('/login', [StudentsController::class, 'LoginEmployeeOrSpecialist']);//??
//BAYAN============================================================
Route::get('/listStudentBudget', [StudentsController::class, 'listStudentBudget']);
Route::post('/addPayment/{StudentID}', [StudentsController::class, 'addPayment']);


Route::prefix('employee')->group(function () {
    Route::post('/addEmployee', [EmployeeController::class, 'storeEmployee']);
    Route::get('/accept', [EmployeeController::class, 'employeeAccept']);
    Route::get('/archives', [EmployeeController::class, 'employeeArchives']);
    Route::get('/show/{employeeID}', [EmployeeController::class, 'showEmployee']);
    Route::post('/status/{employeeID}', [EmployeeController::class, 'status']);
    Route::get('/countEmployee', [EmployeeController::class, 'countEmployee']);
    Route::delete('/deleteEmployee/{employeeID}', [EmployeeController::class, 'destroyEmployee']);


});
Route::prefix('user')->group(function () {
    Route::get('/list', [UserRoleController::class, 'indexList']);
    Route::get('/getinfo/{userId}', [UserRoleController::class, 'getinfo']);
    Route::get('/listName', [UserRoleController::class, 'indexName']);
    Route::post('/adduser', [UserRoleController::class, 'adduser']);
    Route::post('/login', [UserRoleController::class, 'login']);
    Route::delete('/deleteUser/{userId}', [UserRoleController::class, 'destroyUser']);
    Route::post('/editUser/{userId}', [UserRoleController::class, 'updateUser']);
//   Route::post('/status/{employeeID}', [EmployeeController::class, 'status']);

});
Route::prefix('role')->group(function () {
    Route::get('/list', [RoleController::class, 'indexRole']);
    Route::get('/listrole', [PermissionRecordeController::class, 'indexListRole']);


//    Route::post('/status/{employeeID}', [EmployeeController::class, 'status']);

});
Route::prefix('student')->group(function () {
    Route::get('/countStudent', [StudentsController::class, 'countStudents']);

});
Route::prefix('report')->group(function () {
    Route::get('/countReport', [ReportsController::class, 'countReports']);
    Route::get('/list', [ReportsController::class, 'indexReport']);


});
Route::post('/showSectionB', [SectionsController::class, 'showSectionDash']);//
//Route::get('/showClass', [ClassStudentsController::class, 'showClass']);//
Route::post('/showProgramDash', [StudyProgramController::class, 'showProgramDash']);//
Route::get('/logout', [UserRoleController::class, 'logout'])->middleware('auth:api');
//BAYAN============================================================

//RaghadK============================================================

Route::post('create_note',[NotesController::class,'create']);
Route::post('create_section',[SectionsController::class,'create']);//s
Route::get('show_class_sections',[SectionsController::class,'show']);//s
Route::delete('delet_section/{section_id}',[SectionsController::class,'destroy']);
Route::get('get_students',[SectionsController::class,'get_students_withoutSection']);
Route::put('add_studentToSection',[SectionsController::class,'add_studentToSection']);
Route::post('create_subject_class',[SubjectsClassController::class,'create']);
Route::get('show_subjects',[SubjectsClassController::class,'show']);
Route::delete('delet_subjectclass/{subjectclass_id}',[SubjectsClassController::class,'destroy']);
Route::post('create_workpapers',[WorkingPapersSectionController::class,'create']);
Route::post('create_workpapersType',[WorkingPapersTypeController::class,'create']);
Route::post('create_program',[StudyProgramController::class,'create']);
Route::get('show_program',[StudyProgramController::class,'show']);
Route::delete('delet_program/{section_id}',[StudyProgramController::class,'destroy']);
Route::get('get_subjectsList',[SubjectsController::class,'show']);
Route::get('get_WorkingPapersTypeList',[WorkingPapersTypeController::class,'show']);

//RaghadK============================================================
//Me============================================================



Route::group([
    'prefix' => 'student'
], function () {


    Route::post('/login', [StudentsController::class,'login_student']);
    Route::group([
        'middleware' => 'auth:sanctum'
    ], function() {
        Route::get('/logout', [StudentsController::class,'logout_student']);
        Route::get('/show/notes/{type}', [NotesController::class, 'show_students']);//->middleware('auth:sanctum');
        Route::get('/index/absence', [AbsenceController::class, 'index_student']) ;//->middleware('auth:sanctum');;
        Route::get('/show/absence/{kind}', [AbsenceController::class, 'show_student']) ;//->middleware('auth:sanctum');;
        Route::get('/index/delay', [DelayController::class, 'index_student']) ;//->middleware('auth:sanctum');;
        Route::get('/show/delay/{kind}', [DelayController::class, 'show_student']) ;//->middleware('auth:sanctum');;
        Route::get('/index/permission', [PermissionController::class, 'index_student']) ;//->middleware('auth:sanctum');;
        Route::get('/show/permission', [PermissionController::class, 'showd_student']) ;//->middleware('auth:sanctum');;
        Route::post('/store/report', [ReportsController::class, 'store_student']) ;//??
        Route::get('/show/report', [ReportsController::class, 'show_student']) ;//??
        Route::post('/show/mark', [MarksController::class, 'show_student']) ;//->middleware('auth:sanctum');;
        Route::get('/show/program', [StudyProgramController::class, 'show_student']) ;//->middleware('auth:sanctum');;
        Route::get('/show/subject', [SubjectsClassController::class, 'show_student']) ;//??
        Route::get('/show/ads/{type}', [SectionAdsController::class, 'show_student']) ;//->middleware('auth:sanctum');;
        Route::get('/show/workingpaper/{type}', [WorkingPapersSectionController::class, 'show_studen']) ;//->middleware('auth:sanctum');;
        Route::get('/show/Premium', [PremiumController::class, 'Show_student']) ;//->middleware('auth:sanctum');;

    });
});

//Me============================================================



Route::get('/h', function () {
     dd("pop");  
});


/////////////////////////////


//  php artisan db:seed --class=class AbsenceSeeder
//  php artisan db:seed --class=class AdsSeeder
//  php artisan db:seed --class=class Class_studentSeeder
//  php artisan db:seed --class=class ComplaintSeeder
//  php artisan db:seed --class=class DatabaseSeeder
//  php artisan db:seed --class=class DelaySeeder
//
//  php artisan db:seed --class=class Follow_up_typeSeeder
//  php artisan db:seed --class=class IllnesseSeeder
//
//  php artisan db:seed --class=class PermissionSeeder
//
//  php artisan db:seed --class=class ReportSeeder
//  php artisan db:seed --class=class RoleSeeder
//  php artisan db:seed --class=class Section_adsSeeder
//  php artisan db:seed --class=class Section_studentsSeeder
//  php artisan db:seed --class=class SectionSeeder
//  php artisan db:seed --class=class StudentSeeder
//  php artisan db:seed --class=class Subject_classSeeder
//  php artisan db:seed --class=class SubjectSeeder
//  php artisan db:seed --class=class User_roleSeeder
//  php artisan db:seed --class=class UserSeeder
//  php artisan db:seed --class=class EmployeeSeeder
//  php artisan db:seed --class=class MarkSeeder
//  php artisan db:seed --class=class PreviousJobSeeder
//php artisan db:seed --class=class NoteSeeder
// studyprogram??



