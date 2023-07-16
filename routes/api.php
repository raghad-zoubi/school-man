<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\DelayController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SectionAdsController;
use App\Http\Controllers\StudentsController;
<<<<<<< HEAD
use App\Http\Controllers\NotesController;
use App\Http\Controllers\SectionsController;
//use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\SubjectsClassController;
use App\Http\Controllers\WorkingPapersSectionController;
use App\Http\Controllers\WorkingPapersTypeController;
=======
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\SubjectsClassController;
>>>>>>> 42231069c138dd2b54d030622428f18629ccb4f5
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {


});
//maria==================================
Route::post('/store', [StudentsController::class, 'store']);
Route::get('/index', [StudentsController::class, 'index']);
Route::post('/indexDelay', [DelayController::class, 'index']);
Route::post('/indexAbsence', [AbsenceController::class, 'index']);
Route::post('/indexPermission', [PermissionController::class, 'index']);
Route::post('/storeDelay', [DelayController::class, 'store']);
Route::post('/storeAbsence', [AbsenceController::class, 'store']);
Route::post('/storePermission', [PermissionController::class, 'store']);
Route::post('/showAbsenceStudent', [AbsenceController::class, 'show']);
//maria===================================================

Route::group([
    'prefix' => 'student'
], function () {

<<<<<<< HEAD
//////////////
Route::post('create_note',[NotesController::class,'create']);
Route::post('create_section',[SectionsController::class,'create']);
Route::get('show_class_sections',[SectionsController::class,'show']);
Route::delete('delet_section/{section_id}',[SectionsController::class,'destroy']);
Route::get('get_students',[SectionsController::class,'get_students_withoutSection']);
Route::put('add_studentToSection',[SectionsController::class,'add_studentToSection']);
//Route::post('create_subject',[SubjectsController::class,'create']);
Route::post('create_subject_class',[SubjectsClassController::class,'create']);
Route::get('show_subjects',[SubjectsClassController::class,'show']);
Route::delete('delet_subjectclass/{subjectclass_id}',[SubjectsClassController::class,'destroy']);
Route::post('create_workpapers',[WorkingPapersSectionController::class,'create']);
Route::post('create_workpapersType',[WorkingPapersTypeController::class,'create']);
=======

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
        Route::post('/store/report', [ReportsController::class, 'store_student']) ;//->middleware('auth:sanctum');;
        Route::get('/show/report', [ReportsController::class, 'show_student']) ;//->middleware('auth:sanctum');;
        Route::post('/show/mark', [MarksController::class, 'show_student']) ;//->middleware('auth:sanctum');;
        Route::get('/show/program', [StudyProgramController::class, 'show_student']) ;//->middleware('auth:sanctum');;
        Route::get('/show/subject', [SubjectsClassController::class, 'show_student']) ;//->middleware('auth:sanctum');;
        Route::get('/show/ads', [SectionAdsController::class, 'show_student']) ;//->middleware('auth:sanctum');;

    });
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
>>>>>>> 42231069c138dd2b54d030622428f18629ccb4f5
