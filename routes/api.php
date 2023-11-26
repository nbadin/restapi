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

Route::get('/companies/top', [\App\Http\Controllers\api\CompanyController::class, 'top']);
Route::apiResource('/companies', \App\Http\Controllers\api\CompanyController::class);
Route::apiResource('/users', \App\Http\Controllers\api\UserController::class);
Route::apiResource('/comments', \App\Http\Controllers\api\CommentController::class);
Route::get('/companies/{companyId}/comments', [\App\Http\Controllers\api\CompanyController::class, 'comments']);
Route::get('/companies/{companyId}/grade', [\App\Http\Controllers\api\CompanyController::class, 'grade']);
