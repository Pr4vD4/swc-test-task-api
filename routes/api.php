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
    Route::get('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);
});

Route::group(['middleware' => ['jwt.auth'], 'prefix' => 'profile'], function () {
    Route::get('/', [\App\Http\Controllers\API\UserController::class, 'profile']);
    Route::get('/events/appointments', [\App\Http\Controllers\API\UserController::class, 'events']);
    Route::get('/events/created', [\App\Http\Controllers\API\UserController::class, 'user_events']);
    Route::delete('/delete', [\App\Http\Controllers\API\UserController::class, 'delete']);
});

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::resources([
        'events' => \App\Http\Controllers\API\EventController::class,
        'users' => \App\Http\Controllers\API\UserController::class
    ]);

    Route::post('/add/event/{id}', [\App\Http\Controllers\API\UserController::class, 'add_event']);
    Route::post('/detach/event/{id}', [\App\Http\Controllers\API\UserController::class, 'detach_event']);
    Route::delete('/delete/event/{id}', [\App\Http\Controllers\API\EventController::class, 'delete_user_event']);

});
