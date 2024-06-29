<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Http\Response;

class TasksController extends Controller
{
    public function welcome() {
        return view('tasks.welcome');
    }

    public function todo() {    
        return view('tasks.index');
    }

    public function completed() {    
        return view('tasks.complete_index');
    }

    public function add(Request $request)       
    {
        $validatedData = $request->validate([
            'task_name' => 'required|string|max:255',
        ]);

        Todo::create([
            'task_name' => $validatedData['task_name'],
            'is_complete' => 0   // Not yet completed
        ]);

        return response([
            'message' => "Task added successfully"
        ], 200);
    }

    /** Get all tasks */
    public function get()
    {
        $tasks = Todo::orderBy('is_complete', 'asc')->get();

        return response([
            'tasks' => $tasks,
            'message' => "Tasks successfully retrieved"
        ], 200);
    }

    /** Update task status */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'is_complete' => 'required|boolean'
        ]);

        $task = Todo::findOrFail($id);

        $task->is_complete = $validatedData['is_complete'];
        $task->save();

        return response([
            'message' => "Task status updated successfully"
        ], 200);
    }

    /** Delete task */
    public function delete(int $id)
    {
        $task = Todo::findOrFail($id);
        $task->delete();

        return response([
            'message' => "Task deleted successfully"
        ], 200);
    }
}