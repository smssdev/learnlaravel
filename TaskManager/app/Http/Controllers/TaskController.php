<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $task= Task::all();
        return response()->json($task,200);
    }
    public function store(StoreTaskRequest $request)
    {
        $task= Task::create($request->validated());
        return response()->json($task,201);
    }
    public function update(UpdateTaskRequest $request, $id)
    {
        $task= Task::findOrFail($id);
        $validatedData= $request->validated();
         $task->update($validatedData);
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
    public function getTaskUser($id)
    {
        $user = Task::findOrFail($id)->user;
        return response()->json($user,200);
    }
    public function addCategoriesToTask(Request $request, $taskId) {
      $task= Task::findOrFail($taskId);
      $task->categories()->attach($request->category_id);
      return response()->json('Category attached succefully',200);
    }
}
