<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'login']);
Route::post('logout', [UserController::class,'logout'])->middleware('auth:sanctum');




Route::apiResource('tasks', TaskController::class)->middleware('auth:sanctum');
Route::get('task/{id}/user', [TaskController::class,'getTaskUser']);
Route::post('tasks/{taskId}/categories',[TaskController::class,'addCategoriesToTask']);
Route::get('tasks/{taskId}/categories',[TaskController::class,'getTaskCategories']);
Route::get('categories/{categoryId}/tasks',[TaskController::class,'getCategoryTasks']);

Route::apiResource('profiles', ProfileController::class);

Route::get('user/{id}/profile', [UserController::class,'getUserProfile']);
Route::get('user/{id}/tasks', [UserController::class,'getUserTasks']);
