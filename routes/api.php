<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConteoFigController;
use App\Http\Controllers\Creencias1Controller;
use App\Http\Controllers\Creencias2Controller;
use App\Http\Controllers\Creencias3Controller;
use App\Http\Controllers\Creencias4Controller;
use App\Http\Controllers\EscenariosRealistasController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\RazonamientoLogController;
use App\Http\Controllers\RazonamientoNumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::apiResource('pruebas', PruebaController::class)->middleware('auth:sanctum');


Route::apiResource('creencias_personales1', Creencias1Controller::class);
Route::apiResource('creencias_personales2', Creencias2Controller::class);
Route::apiResource('creencias_personales3', Creencias3Controller::class);
Route::apiResource('creencias_personales4', Creencias4Controller::class);
Route::apiResource('razonamiento_numerico', RazonamientoNumController::class);
Route::apiResource('razonamiento_logico', RazonamientoLogController::class);

Route::apiResource('escenariosRealistas', EscenariosRealistasController::class);
Route::get('escenariosRealistas/applicant/{applicantId}', [EscenariosRealistasController::class, 'getByApplicantId']);
Route::patch('escenariosRealistas/update/{applicantId}', [EscenariosRealistasController::class, 'update']);

Route::get('creencias_personales1/applicant/{applicantId}', [Creencias1Controller::class, 'getByApplicantId']);
Route::patch('creencias_personales1/update/{applicantId}', [Creencias1Controller::class, 'update']);

Route::get('creencias_personales2/applicant/{applicantId}', [Creencias2Controller::class, 'getByApplicantId']);
Route::patch('creencias_personales2/update/{applicantId}', [Creencias2Controller::class, 'update']);

Route::get('creencias_personales3/applicant/{applicantId}', [Creencias3Controller::class, 'getByApplicantId']);
Route::patch('creencias_personales3/update/{applicantId}', [Creencias3Controller::class, 'update']);

Route::get('creencias_personales4/applicant/{applicantId}', [Creencias4Controller::class, 'getByApplicantId']);
Route::patch('creencias_personales4/update/{applicantId}', [Creencias4Controller::class, 'update']);

Route::get('razonamiento_numerico/applicant/{applicantId}', [RazonamientoNumController::class, 'getByApplicantId']);
Route::patch('razonamiento_numerico/update/{applicantId}', [RazonamientoNumController::class, 'update']);

Route::apiResource('applicant', ApplicantController::class);
Route::get('/applicant/rfc/{rfc}', [ApplicantController::class, 'getApplicantByRFC']);

// Control de usuarios
Route::post('/register', [AuthController::class, 'register']);
Route::get('/users-index', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::put('users/{id}/status', [AuthController::class, 'updateStatus'])->middleware('auth:sanctum');
Route::delete('users/{id}', [AuthController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);


Route::get('razonamiento_logico/applicant/{applicantId}', [RazonamientoLogController::class, 'getByApplicantId']);
Route::patch('razonamiento_logico/update/{applicantId}', [RazonamientoLogController::class, 'update']);

Route::apiResource('conteo_figuras', ConteoFigController::class);



