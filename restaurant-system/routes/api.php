<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::middleware(['role:admin'])->group(function () {
        Route::apiResource('items', ItemController::class);
        Route::apiResource('orders', OrderController::class);
        Route::get('tables', [TableController::class, 'index']);
        Route::patch('tables/{table}/status', [TableController::class, 'updateStatus']);
        Route::get('users', [UserController::class, 'index']);
        Route::post('users', [UserController::class, 'store']);
        Route::patch('users/{user}', [UserController::class, 'update']);
        Route::delete('users/{user}', [UserController::class, 'destroy']);
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('reports', [ReportController::class, 'index']);
    });
});
