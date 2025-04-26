<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('welcome'); // سترجع الواجهة الرئيسية لVue
})->where('any', '.*');
