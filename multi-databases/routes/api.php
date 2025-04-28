<?php

use App\Http\Controllers\MultiDbController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/users', [MultiDbController::class, 'users']);
Route::post('/users', [MultiDbController::class, 'addUser']);

Route::get('/posts', [MultiDbController::class, 'posts']);
Route::post('/posts', [MultiDbController::class, 'addPost']);
