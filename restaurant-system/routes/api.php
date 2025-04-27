<?php

use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ReportController as ApiReportController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [ProfileController::class, 'show']);

    Route::middleware(['role:admin'])->group(function () {
        Route::apiResource('items', ItemController::class);
        Route::apiResource('orders', OrderController::class);
        Route::get('tables', [TableController::class, 'index']);
        Route::patch('tables/{table}/status', [TableController::class, 'updateStatus']);
        Route::apiResource('users', UserController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('images', ImageController::class)->except(['update']);
        Route::get('reports', [ApiReportController::class, 'index']);
        Route::apiResource('roles', RoleController::class);
    });
});
