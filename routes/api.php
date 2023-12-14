<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('/register', [\App\Http\Controllers\API\AuthController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);
    Route::get('/profile', [\App\Http\Controllers\API\AuthController::class, 'profile']);
});

Route::group(['middleware' => ['jwt.auth'], 'prefix' => 'admin'], function () {
    Route::resources([
        'users' => \App\Http\Controllers\API\UserController::class
    ]);
});
