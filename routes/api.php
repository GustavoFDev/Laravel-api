<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Creencias1Controller;
use App\Http\Controllers\PruebaController;   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::apiResource('pruebas', PruebaController::class)->middleware('auth:sanctum');

Route::apiResource(name: 'creencias_personales1', controller: Creencias1Controller::class);
Route::get('creencias_personales1/applicant/{applicantId}', [Creencias1Controller::class, 'getByApplicantId']);

Route::apiResource('applicant', ApplicantController::class);

Route::post('/register', [AuthController::class, 'register']);

Route::get('/users-index', [AuthController::class, 'index'])->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::put('users/{id}/status', [AuthController::class, 'updateStatus'])->middleware('auth:sanctum');

Route::delete('users/{id}', [AuthController::class, 'destroy'])->middleware('auth:sanctum');

