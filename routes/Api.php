<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "Api" middleware group. Make something great!
|
*/

Route::get('/companies/{companyId}/comments', [\App\Http\Controllers\Api\CompanyController::class, 'comments']);
Route::get('/companies/{companyId}/grade', [\App\Http\Controllers\Api\CompanyController::class, 'grade']);
Route::get('/companies/top', [\App\Http\Controllers\Api\CompanyController::class, 'top']);
Route::apiResource('/companies', \App\Http\Controllers\Api\CompanyController::class);
Route::apiResource('/users', \App\Http\Controllers\Api\UserController::class);
Route::apiResource('/comments', \App\Http\Controllers\Api\CommentController::class);
