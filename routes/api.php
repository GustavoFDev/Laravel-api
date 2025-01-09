<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PruebaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::apiResource('pruebas', PruebaController::class)->middleware('auth:sanctum');


Route::apiResource('applicant', ApplicantController::class);

Route::post('/register', [AuthController::class, 'register'])->middleware('auth:sanctum');

Route::get('/users-index', [AuthController::class, 'index'])->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('test_view', ApplicantController::class);