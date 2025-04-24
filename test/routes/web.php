<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return "Welcome";
});

Route::get('/new_page', function () {
    return view("new_page");
});
