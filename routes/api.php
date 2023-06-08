<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\DelayController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StudentsController;
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



Route::post('/student/store', [StudentsController::class, 'store']);
Route::get('/student/index', [StudentsController::class, 'index']);
Route::post('/student/login', [StudentsController::class, 'login_student']);
//Route::middleware('auth:sanctum')->get('/student', function (Request $request) {



Route::get('/show/notes/{type}', [NotesController::class, 'show_students']) ->middleware('auth:sanctum');;
Route::get('/index/absence', [AbsenceController::class, 'index_student']) ->middleware('auth:sanctum');;
Route::get('/show/abence/{kind}', [AbsenceController::class, 'show_student']) ->middleware('auth:sanctum');;
Route::get('/index/delay', [DelayController::class, 'index_student']) ->middleware('auth:sanctum');;
Route::get('/show/delay/{kind}', [DelayController::class, 'show_student']) ->middleware('auth:sanctum');;
Route::get('/index/permission', [PermissionController::class, 'index_student']) ->middleware('auth:sanctum');;
Route::get('/show/permission', [PermissionController::class, 'showd_student']) ->middleware('auth:sanctum');;

