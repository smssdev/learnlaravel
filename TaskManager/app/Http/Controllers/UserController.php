<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserProfile($id)
    {
        $profile = User::find($id)->profile;
        return response()->json($profile,200);
    }
    public function getUserTasks($id)
    {
        $tasks = User::findOrFail($id)->tasks;
        return response()->json($tasks,200);
    }
}
