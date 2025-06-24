<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the API',
        'device' => getDeviceName(),
    ]);
});
Route::group(['prefix' => '/auth'], function () {
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('update', [AuthController::class, 'update']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/sync', [\App\Http\Controllers\SyncController::class, 'sync']);
    Route::get('/sync',[\App\Http\Controllers\SyncController::class, 'getSyncData']);
});
