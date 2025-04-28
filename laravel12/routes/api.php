<?php

use App\Http\Controllers\FlightController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('flights', [FlightController::class, 'index']);
Route::post('flights', [FlightController::class, 'create']);
Route::post('/flights/{id}/increment', [FlightController::class, 'incrementCounter']);

