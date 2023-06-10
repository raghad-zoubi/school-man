<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\DelayController;
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


