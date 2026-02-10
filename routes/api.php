<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\Api\V1\DepartmentController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\Api\V1\UserImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::post('/users/{id}/upload-image', [UserImageController::class, 'store']);
        Route::apiResource('/users', UserController::class);
        Route::apiResource('/projects', ProjectController::class);
        Route::apiResource('/departments', DepartmentController::class);
        Route::apiResource('/tasks', TaskController::class);
    });
});
