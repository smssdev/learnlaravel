<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome() {
        return "Welcome to api from controller";
    }
    public function welcome1() {
        return "Welcome 1";
    }
    public function welcome2() {
        return "Welcome 2";
    }
}
