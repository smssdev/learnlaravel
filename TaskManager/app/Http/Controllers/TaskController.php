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
        $validatedData= $request->validate([
            'title' => 'required|string|max:40',
            'description' => 'nullable|string',
            'priority' => 'required|integer|between:1,5',
        ]);
        $task= Task::create($validatedData);
        return response()->json($task,201);
    }
    public function store2(Request $request)
    {
        $task= new Task;
        $task->title= $request->title;
        $task->description= $request->description;
        $task->priority= $request->priority;
        $task->save();
        return response()->json($task,201);
    }
    public function update(Request $request, $id)
    {
        $task= Task::findOrFail($id);
        $validatedData= $request->validate([
            'title' => 'someTimes|string|max:40',
            'description' => 'someTimes|nullable|string',
            'priority' => 'someTimes|integer|between:1,5',
        ]);
         $task->update($validatedData);
        return response()->json($task,200);
    }
    public function update2(Request $request, $id)
    {
        $task= Task::findOrFail($id);
        $task->title= $request->title;
        $task->description= $request->description;
        $task->priority= $request->priority;
        $task->save();
        return response()->json($task,200);
    }
    public function show($id)
    {
        $task= Task::find($id);
        return response()->json($task,200);
    }
    public function destroy($id)
    {
        $task= Task::findOrFail($id);
         $task->delete($id);
        return response()->json(null,204);
    }
}
