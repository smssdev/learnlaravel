<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $task= Task::all();
        return response()->json($task,200);
    }
    public function store(Request $request)
    {
        $task= Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority
        ]);

        return response()->json($task,201);
    }
}
