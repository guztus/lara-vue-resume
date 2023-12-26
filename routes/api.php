<?php

use App\Http\Controllers\Api\ResumeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', RegisterController::class);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/resume/{id}', [ResumeController::class, 'show']);
    Route::put('/resume/{id}', [ResumeController::class, 'update']);
    Route::delete('/resume/{id}', [ResumeController::class, 'destroy']);

    Route::post('/resume', [ResumeController::class, 'store']);
    Route::get('/resumes', [ResumeController::class, 'index']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/user', UserController::class);
