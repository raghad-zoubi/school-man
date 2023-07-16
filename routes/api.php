<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\DelayController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\SectionsController;
//use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\SubjectsClassController;
use App\Http\Controllers\WorkingPapersSectionController;
use App\Http\Controllers\WorkingPapersTypeController;
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
Route::post('/login', [StudentsController::class, 'LoginEmployeeOrSpecialist']);


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
