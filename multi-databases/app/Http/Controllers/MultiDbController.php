<?php

namespace App\Http\Controllers;

use App\Models\PostDb2;
use App\Models\UserDb1;
use Illuminate\Http\Request;

class MultiDbController extends Controller
{
    // 🧑‍💻 عمليات على قاعدة db1
    public function users()
    {
        return UserDb1::all();
    }

    public function addUser(Request $request)
    {
        return UserDb1::create(['name' => $request->name]);
    }

    // 📝 عمليات على قاعدة db2
    public function posts()
    {
        return PostDb2::all();
    }

    public function addPost(Request $request)
    {
        return PostDb2::create(['title' => $request->title]);
    }
}
