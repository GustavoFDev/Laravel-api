<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreenciasPController;
use App\Http\Controllers\PruebaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::apiResource('pruebas', PruebaController::class)->middleware('auth:sanctum');

Route::apiResource(name: 'creencias_personales1', controller: CreenciasPController::class);

Route::apiResource('applicant', ApplicantController::class);

Route::apiResource('test_view', ApplicantController::class);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');